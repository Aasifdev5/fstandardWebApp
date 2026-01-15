<?php

namespace App\Services\AI;

use App\Models\PsychometricSnapshot;
use App\Models\PsychometricExplanation;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PsychometricExplainService
{
    protected string $model = 'gpt-4o-mini'; // Fast, cheap, safe model (or 'claude-3-haiku', 'gemini-1.5-flash')
    protected float $temperature = 0.3;
    protected int $maxTokens = 250;
    protected string $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openai.key'); // Add to config/services.php or .env
        if (empty($this->apiKey)) {
            throw new \Exception('OpenAI API key not configured');
        }
    }

    /**
     * Generate explanation from latest snapshot for a user
     * Returns saved explanation model or null on failure
     */
    public function generateForUser(int $userId): ?PsychometricExplanation
    {
        $snapshot = PsychometricSnapshot::where('user_id', $userId)
            ->latest('created_at')
            ->first();

        if (!$snapshot) {
            return null;
        }

        $scores = $snapshot->only([
            'impulse_score',
            'discipline_score',
            'emotional_stability',
            'risk_consistency',
            'recovery_behavior',
            'confidence_gap'
        ]);

        $prompt = $this->buildSafePrompt($scores);

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model'       => $this->model,
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => 'You are a supportive, non-judgmental trading psychology coach. Use simple, encouraging English. Focus only on behavior patterns from the given scores. Never mention prices, markets, specific trades, or give any trading advice. Suggest one small, general improvement idea.'
                    ],
                    [
                        'role'    => 'user',
                        'content' => $prompt
                    ],
                ],
                'temperature' => $this->temperature,
                'max_tokens'  => $this->maxTokens,
            ]);

            if (!$response->successful()) {
                throw new \Exception('API request failed: ' . $response->body());
            }

            $text = trim($response->json()['choices'][0]['message']['content'] ?? '');

            if (empty($text)) {
                throw new \Exception('Empty AI response');
            }

            return PsychometricExplanation::create([
                'user_id'      => $userId,
                'explanation'  => $text,
                'generated_by' => 'AI',
            ]);

        } catch (\Exception $e) {
            Log::error("Psychometric AI explanation failed for user {$userId}: " . $e->getMessage());

            // Fallback: simple rule-based explanation (never leave user without insight)
            $fallbackText = $this->generateFallbackExplanation($scores);

            return PsychometricExplanation::create([
                'user_id'      => $userId,
                'explanation'  => $fallbackText,
                'generated_by' => 'SYSTEM',
            ]);
        }
    }

    /**
     * Extremely safe prompt – NUMERIC SCORES ONLY
     */
    protected function buildSafePrompt(array $scores): string
    {
        return "Here are the user's recent trading behavior scores (0–100 scale):\n\n" .
               "Impulse Score: {$scores['impulse_score']}\n" .
               "Discipline Score: {$scores['discipline_score']}\n" .
               "Emotional Stability: {$scores['emotional_stability']}\n" .
               "Risk Consistency: {$scores['risk_consistency']}\n" .
               "Recovery Behavior: {$scores['recovery_behavior']}\n" .
               "Confidence Gap: {$scores['confidence_gap']}\n\n" .
               "Write a short, encouraging paragraph (3–5 sentences) in simple English that explains what these scores suggest about the trader's recent behavior. " .
               "Be supportive and positive. Suggest one small, general improvement idea (e.g., 'consider taking short breaks after losses'). " .
               "Never mention prices, market direction, specific trades, or give any trading advice. Keep under 150 words.";
    }

    /**
     * Simple fallback if AI fails – still helpful
     */
    protected function generateFallbackExplanation(array $scores): string
    {
        $issues = [];

        if ($scores['impulse_score'] > 70) $issues[] = "higher impulse trading";
        if ($scores['discipline_score'] < 50) $issues[] = "lower discipline during sequences";
        if ($scores['emotional_stability'] < 50) $issues[] = "emotional reactions to drawdowns";
        if ($scores['risk_consistency'] < 50) $issues[] = "inconsistent risk sizing";

        if (empty($issues)) {
            return "Your recent scores show good overall stability and consistency. Keep doing what works — small, steady improvements will compound over time.";
        }

        $issueText = implode(', ', $issues);
        return "Your recent behavior shows some $issueText. That's completely normal — many traders experience this. Consider one small step like reviewing trades calmly after sessions to build even stronger habits.";
    }
}
