@extends('user-master')
@section('title', 'Trading Calculator')

<style>
    :root {
        --primary-color: #4361ee;
        --primary-light: #4895ef;
        --secondary-color: #3a0ca3;
        --success-color: #4cc9f0;
        --danger-color: #f72585;
        --warning-color: #f8961e;
        --dark-bg: #0d1117;
        --card-bg: #161b22;
        --card-border: #30363d;
        --text-primary: #f0f6fc;
        --text-secondary: #8b949e;
        --hover-bg: #21262d;
        --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        --profit-gradient: linear-gradient(135deg, #4cc9f0 0%, #2a9d8f 100%);
        --loss-gradient: linear-gradient(135deg, #f72585 0%, #d90429 100%);
    }

    body {
        background: var(--dark-bg);
        min-height: 100vh;
        color: var(--text-primary);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .calculator-header {
        background: var(--gradient);
        padding: 60px 0 40px;
        position: relative;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .calculator-header::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -150px;
        right: -100px;
        opacity: 0.3;
    }

    .calculator-header-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        text-align: center;
    }

    .calculator-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin-bottom: 15px;
        background: linear-gradient(120deg, #fff 0%, rgba(255,255,255,0.8) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 20px rgba(0,0,0,0.1);
    }

    .calculator-subtitle {
        font-size: 1.2rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .main-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .tab-navigation {
        display: flex;
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 8px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .tab-btn {
        flex: 1;
        padding: 15px 20px;
        background: transparent;
        border: none;
        color: var(--text-secondary);
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 8px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-width: 180px;
    }

    .tab-btn:hover {
        color: var(--text-primary);
        background: rgba(255, 255, 255, 0.05);
    }

    .tab-btn.active {
        background: var(--gradient);
        color: white;
        box-shadow: 0 5px 20px rgba(67, 97, 238, 0.3);
    }

    .tab-btn i {
        font-size: 1.2rem;
    }

    .calculator-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .calculator-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .card-title {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.4rem;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .card-title i {
        color: var(--primary-color);
        background: rgba(67, 97, 238, 0.1);
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .input-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 30px;
    }

    .input-group {
        position: relative;
    }

    .input-label {
        display: block;
        color: var(--text-primary);
        font-weight: 500;
        margin-bottom: 10px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .input-label i {
        color: var(--primary-light);
        font-size: 0.9rem;
    }

    .input-wrapper {
        position: relative;
    }

    .input-field {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: 'SF Mono', 'Monaco', monospace;
    }

    .input-field:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        background: rgba(255, 255, 255, 0.05);
    }

    .input-suffix {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-weight: 500;
        pointer-events: none;
    }

    .select-field {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%238b949e' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px;
    }

    .select-field:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        background-color: rgba(255, 255, 255, 0.05);
    }

    .select-field option {
        background: var(--card-bg);
        color: var(--text-primary);
    }

    .result-section {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .result-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .result-card {
        background: var(--hover-bg);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .result-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
    }

    .result-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .result-value {
        font-size: 2rem;
        font-weight: 700;
        font-family: 'SF Mono', 'Monaco', monospace;
        margin: 5px 0;
    }

    .result-value.profit {
        background: var(--profit-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .result-value.loss {
        background: var(--loss-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .result-subtext {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-top: 5px;
    }

    .result-breakdown {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .breakdown-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .breakdown-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .breakdown-item:last-child {
        border-bottom: none;
    }

    .breakdown-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .breakdown-value {
        color: var(--text-primary);
        font-weight: 600;
        font-family: 'SF Mono', 'Monaco', monospace;
    }

    .btn-calculate {
        background: var(--gradient);
        border: none;
        color: white;
        padding: 16px 36px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        margin-top: 20px;
    }

    .btn-calculate:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(67, 97, 238, 0.3);
    }

    .btn-calculate::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.7s ease;
    }

    .btn-calculate:hover::before {
        left: 100%;
    }

    .btn-reset {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--card-border);
        color: var(--text-primary);
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        margin-top: 15px;
    }

    .btn-reset:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--danger-color);
        color: var(--danger-color);
        transform: translateY(-2px);
    }

    .disclaimer {
        background: rgba(248, 150, 30, 0.1);
        border: 1px solid rgba(248, 150, 30, 0.3);
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
        color: var(--warning-color);
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .disclaimer i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .tutorial-section {
        background: rgba(76, 201, 240, 0.1);
        border: 1px solid rgba(76, 201, 240, 0.3);
        border-radius: 12px;
        padding: 25px;
        margin-top: 30px;
    }

    .tutorial-title {
        color: var(--success-color);
        font-weight: 600;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .tutorial-content {
        color: var(--text-secondary);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .tutorial-content ul {
        margin: 10px 0;
        padding-left: 20px;
    }

    .tutorial-content li {
        margin-bottom: 8px;
    }

    .market-data {
        background: rgba(67, 97, 238, 0.1);
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 12px;
        padding: 20px;
        margin-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .market-item {
        text-align: center;
        flex: 1;
        min-width: 150px;
    }

    .market-label {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .market-value {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1.2rem;
        font-family: 'SF Mono', 'Monaco', monospace;
    }

    .market-change {
        font-size: 0.85rem;
        font-weight: 600;
        margin-top: 5px;
    }

    .market-change.positive {
        color: var(--success-color);
    }

    .market-change.negative {
        color: var(--danger-color);
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .tab-content.active {
        display: block;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-secondary);
    }

    .empty-state-icon {
        font-size: 5rem;
        color: var(--primary-color);
        opacity: 0.2;
        margin-bottom: 20px;
        display: inline-block;
    }

    .empty-state h5 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 1rem;
        max-width: 400px;
        margin: 0 auto 30px;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .calculator-title {
            font-size: 2.2rem;
        }

        .calculator-subtitle {
            font-size: 1.1rem;
        }

        .tab-navigation {
            flex-direction: column;
        }

        .tab-btn {
            min-width: 100%;
        }

        .input-grid {
            grid-template-columns: 1fr;
        }

        .result-grid {
            grid-template-columns: 1fr;
        }

        .market-data {
            flex-direction: column;
            align-items: stretch;
        }

        .market-item {
            min-width: 100%;
        }
    }
</style>


@section('content')
<!-- Calculator Header -->
<section class="calculator-header">
    <div class="calculator-header-content">
        <h1 class="calculator-title">
            <i class="fas fa-calculator me-3"></i>Indian Stock Market Calculator
        </h1>
        <p class="calculator-subtitle">
            Advanced trading calculators for Indian stock market - Calculate profits, losses, margins, and more
        </p>
    </div>
</section>

<!-- Main Container -->
<div class="main-container">
    <!-- Tab Navigation -->
    <div class="tab-navigation">
        <button class="tab-btn active" data-tab="profit-calculator">
            <i class="fas fa-chart-line"></i>Profit & Loss
        </button>
        <button class="tab-btn" data-tab="margin-calculator">
            <i class="fas fa-balance-scale"></i>Margin Calculator
        </button>
        <button class="tab-btn" data-tab="risk-calculator">
            <i class="fas fa-shield-alt"></i>Risk Management
        </button>
        <button class="tab-btn" data-tab="tax-calculator">
            <i class="fas fa-rupee-sign"></i>Tax Calculator
        </button>
    </div>

    <!-- Market Data -->
    <div class="market-data">
        <div class="market-item">
            <div class="market-label">NIFTY 50</div>
            <div class="market-value" id="niftyValue">22,156.75</div>
            <div class="market-change positive" id="niftyChange">+0.85%</div>
        </div>
        <div class="market-item">
            <div class="market-label">SENSEX</div>
            <div class="market-value" id="sensexValue">72,843.92</div>
            <div class="market-change positive" id="sensexChange">+0.72%</div>
        </div>
        <div class="market-item">
            <div class="market-label">BANK NIFTY</div>
            <div class="market-value" id="bankNiftyValue">47,315.60</div>
            <div class="market-change negative" id="bankNiftyChange">-0.25%</div>
        </div>
        <div class="market-item">
            <div class="market-label">USD/INR</div>
            <div class="market-value" id="usdInrValue">83.42</div>
            <div class="market-change positive" id="usdInrChange">+0.12%</div>
        </div>
    </div>

    <!-- Profit & Loss Calculator -->
    <div id="profit-calculator" class="tab-content active">
        <div class="calculator-card">
            <h3 class="card-title">
                <i class="fas fa-chart-line"></i>
                Profit & Loss Calculator
            </h3>

            <div class="input-grid">
                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-rupee-sign"></i>Stock Symbol
                    </label>
                    <div class="input-wrapper">
                        <select class="select-field" id="stockSymbol">
                            <option value="RELIANCE">RELIANCE - Reliance Industries</option>
                            <option value="TCS">TCS - Tata Consultancy Services</option>
                            <option value="HDFCBANK">HDFCBANK - HDFC Bank</option>
                            <option value="INFY">INFY - Infosys</option>
                            <option value="ICICIBANK">ICICIBANK - ICICI Bank</option>
                            <option value="SBIN">SBIN - State Bank of India</option>
                            <option value="BHARTIARTL">BHARTIARTL - Bharti Airtel</option>
                            <option value="ITC">ITC - ITC Limited</option>
                            <option value="LT">LT - Larsen & Toubro</option>
                            <option value="HINDUNILVR">HINDUNILVR - Hindustan Unilever</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-hand-holding-usd"></i>Buy Price (₹)
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="buyPrice" placeholder="e.g., 2500" min="0" step="0.01">
                        <span class="input-suffix">₹</span>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-chart-bar"></i>Sell Price (₹)
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="sellPrice" placeholder="e.g., 2800" min="0" step="0.01">
                        <span class="input-suffix">₹</span>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-boxes"></i>Quantity
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="quantity" placeholder="e.g., 100" min="1" value="100">
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-percentage"></i>Brokerage (%)
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="brokerage" placeholder="e.g., 0.5" min="0" max="100" step="0.01" value="0.5">
                        <span class="input-suffix">%</span>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-tags"></i>Transaction Type
                    </label>
                    <div class="input-wrapper">
                        <select class="select-field" id="transactionType">
                            <option value="intraday">Intraday (0.025% STT)</option>
                            <option value="delivery">Delivery (0.1% STT)</option>
                            <option value="futures">Futures (0.01% STT)</option>
                            <option value="options">Options (0.05% STT)</option>
                        </select>
                    </div>
                </div>
            </div>

            <button class="btn-calculate" onclick="calculateProfitLoss()">
                <i class="fas fa-calculator"></i> Calculate Profit/Loss
            </button>

            <button class="btn-reset" onclick="resetProfitCalculator()">
                <i class="fas fa-redo"></i> Reset Calculator
            </button>

            <!-- Results Section -->
            <div id="profitResults" class="result-section" style="display: none;">
                <h4 class="mb-4" style="color: var(--text-primary);">Calculation Results</h4>

                <div class="result-grid">
                    <div class="result-card">
                        <div class="result-label">Net P&L</div>
                        <div class="result-value" id="netPnl">₹0.00</div>
                        <div class="result-subtext" id="pnlPercentage">0.00%</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Gross P&L</div>
                        <div class="result-value" id="grossPnl">₹0.00</div>
                        <div class="result-subtext">Before charges</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Total Investment</div>
                        <div class="result-value" id="totalInvestment">₹0.00</div>
                        <div class="result-subtext">Buy value + charges</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Total Charges</div>
                        <div class="result-value" id="totalCharges">₹0.00</div>
                        <div class="result-subtext">All fees & taxes</div>
                    </div>
                </div>

                <div class="result-breakdown">
                    <h5 style="color: var(--text-primary); margin-bottom: 15px;">Charges Breakdown</h5>
                    <div class="breakdown-grid">
                        <div class="breakdown-item">
                            <span class="breakdown-label">Brokerage</span>
                            <span class="breakdown-value" id="breakdownBrokerage">₹0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">STT</span>
                            <span class="breakdown-value" id="breakdownStt">₹0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">GST</span>
                            <span class="breakdown-value" id="breakdownGst">₹0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">SEBI Charges</span>
                            <span class="breakdown-value" id="breakdownSebi">₹0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Stamp Duty</span>
                            <span class="breakdown-value" id="breakdownStamp">₹0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Transaction Charges</span>
                            <span class="breakdown-value" id="breakdownTransaction">₹0.00</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tutorial-section">
                <h4 class="tutorial-title">
                    <i class="fas fa-lightbulb"></i>How to use this calculator:
                </h4>
                <div class="tutorial-content">
                    <ul>
                        <li>Enter the buy price at which you purchased the stock</li>
                        <li>Enter the sell price at which you plan to sell</li>
                        <li>Specify the quantity of shares</li>
                        <li>Select your transaction type (intraday/delivery/futures/options)</li>
                        <li>The calculator automatically considers all applicable Indian market charges</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Margin Calculator -->
    <div id="margin-calculator" class="tab-content">
        <div class="calculator-card">
            <h3 class="card-title">
                <i class="fas fa-balance-scale"></i>
                Margin Calculator
            </h3>

            <div class="input-grid">
                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-rupee-sign"></i>Stock Price (₹)
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="marginPrice" placeholder="e.g., 1500" min="0" step="0.01">
                        <span class="input-suffix">₹</span>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-boxes"></i>Quantity
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="marginQuantity" placeholder="e.g., 50" min="1" value="50">
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-exchange-alt"></i>Segment
                    </label>
                    <div class="input-wrapper">
                        <select class="select-field" id="segmentType">
                            <option value="equity">Equity (20%)</option>
                            <option value="intraday">Intraday (5%)</option>
                            <option value="futures">Futures (15%)</option>
                            <option value="options">Options (Premium)</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <label class="input-label">
                        <i class="fas fa-percentage"></i>Margin Required (%)
                    </label>
                    <div class="input-wrapper">
                        <input type="number" class="input-field" id="marginPercent" placeholder="e.g., 20" min="1" max="100" step="0.1">
                        <span class="input-suffix">%</span>
                    </div>
                </div>
            </div>

            <button class="btn-calculate" onclick="calculateMargin()">
                <i class="fas fa-calculator"></i> Calculate Margin
            </button>

            <div id="marginResults" class="result-section" style="display: none;">
                <div class="result-grid">
                    <div class="result-card">
                        <div class="result-label">Margin Required</div>
                        <div class="result-value" id="marginRequired">₹0.00</div>
                        <div class="result-subtext" id="marginPercentText">0.00% of total</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Total Value</div>
                        <div class="result-value" id="totalValue">₹0.00</div>
                        <div class="result-subtext">Quantity × Price</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Leverage</div>
                        <div class="result-value" id="leverage">1.00x</div>
                        <div class="result-subtext">Total / Margin</div>
                    </div>

                    <div class="result-card">
                        <div class="result-label">Exposure Limit</div>
                        <div class="result-value" id="exposureLimit">₹0.00</div>
                        <div class="result-subtext">With this margin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Disclaimer -->
    <div class="disclaimer">
        <i class="fas fa-exclamation-triangle"></i>
        <strong>Disclaimer:</strong> This calculator is for educational purposes only. Actual trading charges may vary based on your broker and market conditions. Always verify with your broker before making trading decisions.
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Tab switching functionality
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all tabs and buttons
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

            // Add active class to clicked button
            button.classList.add('active');

            // Show corresponding content
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Profit & Loss Calculator Functions
    function calculateProfitLoss() {
        const buyPrice = parseFloat(document.getElementById('buyPrice').value) || 0;
        const sellPrice = parseFloat(document.getElementById('sellPrice').value) || 0;
        const quantity = parseInt(document.getElementById('quantity').value) || 0;
        const brokeragePercent = parseFloat(document.getElementById('brokerage').value) || 0;
        const transactionType = document.getElementById('transactionType').value;

        if (buyPrice <= 0 || sellPrice <= 0 || quantity <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Input',
                text: 'Please enter valid buy price, sell price, and quantity',
                confirmButtonColor: '#4361ee',
                background: '#161b22',
                color: '#f0f6fc'
            });
            return;
        }

        // Calculate gross P&L
        const grossPnl = (sellPrice - buyPrice) * quantity;

        // Calculate transaction values
        const buyValue = buyPrice * quantity;
        const sellValue = sellPrice * quantity;

        // Brokerage charges (0.5% default)
        const brokerage = (brokeragePercent / 100) * (buyValue + sellValue);

        // STT (Security Transaction Tax) rates for Indian market
        let sttRate = 0.001; // Default for delivery
        if (transactionType === 'intraday') sttRate = 0.00025; // 0.025%
        if (transactionType === 'futures') sttRate = 0.0001;   // 0.01%
        if (transactionType === 'options') sttRate = 0.0005;   // 0.05% on premium

        const stt = sellValue * sttRate;

        // GST (Goods and Services Tax) - 18% on brokerage + transaction charges
        const gst = brokerage * 0.18;

        // SEBI charges - ₹10 per crore
        const sebiCharges = ((buyValue + sellValue) / 10000000) * 10;

        // Stamp Duty - 0.003% of buy value (varies by state)
        const stampDuty = buyValue * 0.00003;

        // Transaction charges - 0.00345% of turnover
        const transactionCharges = (buyValue + sellValue) * 0.0000345;

        // Total charges
        const totalCharges = brokerage + stt + gst + sebiCharges + stampDuty + transactionCharges;

        // Net P&L
        const netPnl = grossPnl - totalCharges;

        // Calculate percentages
        const pnlPercentage = ((netPnl / buyValue) * 100).toFixed(2);

        // Update UI
        document.getElementById('profitResults').style.display = 'block';
        document.getElementById('netPnl').textContent = `₹${formatIndianCurrency(netPnl)}`;
        document.getElementById('netPnl').className = `result-value ${netPnl >= 0 ? 'profit' : 'loss'}`;
        document.getElementById('pnlPercentage').textContent = `${pnlPercentage}%`;
        document.getElementById('pnlPercentage').style.color = netPnl >= 0 ? 'var(--success-color)' : 'var(--danger-color)';

        document.getElementById('grossPnl').textContent = `₹${formatIndianCurrency(grossPnl)}`;
        document.getElementById('totalInvestment').textContent = `₹${formatIndianCurrency(buyValue + (buyValue * (brokeragePercent/100)))}`;
        document.getElementById('totalCharges').textContent = `₹${formatIndianCurrency(totalCharges)}`;

        // Update breakdown
        document.getElementById('breakdownBrokerage').textContent = `₹${formatIndianCurrency(brokerage)}`;
        document.getElementById('breakdownStt').textContent = `₹${formatIndianCurrency(stt)}`;
        document.getElementById('breakdownGst').textContent = `₹${formatIndianCurrency(gst)}`;
        document.getElementById('breakdownSebi').textContent = `₹${formatIndianCurrency(sebiCharges)}`;
        document.getElementById('breakdownStamp').textContent = `₹${formatIndianCurrency(stampDuty)}`;
        document.getElementById('breakdownTransaction').textContent = `₹${formatIndianCurrency(transactionCharges)}`;

        // Animate results
        animateValue('netPnl', 0, netPnl, 1000);
    }

    function resetProfitCalculator() {
        document.getElementById('buyPrice').value = '';
        document.getElementById('sellPrice').value = '';
        document.getElementById('quantity').value = '100';
        document.getElementById('brokerage').value = '0.5';
        document.getElementById('profitResults').style.display = 'none';
    }

    // Margin Calculator Functions
    function calculateMargin() {
        const price = parseFloat(document.getElementById('marginPrice').value) || 0;
        const quantity = parseInt(document.getElementById('marginQuantity').value) || 0;
        const segment = document.getElementById('segmentType').value;
        let marginPercent = parseFloat(document.getElementById('marginPercent').value) || 0;

        if (price <= 0 || quantity <= 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Input',
                text: 'Please enter valid price and quantity',
                confirmButtonColor: '#4361ee',
                background: '#161b22',
                color: '#f0f6fc'
            });
            return;
        }

        // Set default margin percentages based on segment
        if (marginPercent === 0) {
            if (segment === 'equity') marginPercent = 20;
            if (segment === 'intraday') marginPercent = 5;
            if (segment === 'futures') marginPercent = 15;
            if (segment === 'options') marginPercent = 100; // Options premium
            document.getElementById('marginPercent').value = marginPercent;
        }

        const totalValue = price * quantity;
        const marginRequired = totalValue * (marginPercent / 100);
        const leverage = totalValue / marginRequired;
        const exposureLimit = marginRequired * (100 / marginPercent);

        // Update UI
        document.getElementById('marginResults').style.display = 'block';
        document.getElementById('marginRequired').textContent = `₹${formatIndianCurrency(marginRequired)}`;
        document.getElementById('marginPercentText').textContent = `${marginPercent}% of total`;
        document.getElementById('totalValue').textContent = `₹${formatIndianCurrency(totalValue)}`;
        document.getElementById('leverage').textContent = `${leverage.toFixed(2)}x`;
        document.getElementById('exposureLimit').textContent = `₹${formatIndianCurrency(exposureLimit)}`;

        // Animate results
        animateValue('marginRequired', 0, marginRequired, 1000);
    }

    // Utility Functions
    function formatIndianCurrency(num) {
        if (isNaN(num)) return '0.00';

        const absNum = Math.abs(num);
        if (absNum >= 10000000) {
            return (num / 10000000).toFixed(2) + ' Cr';
        } else if (absNum >= 100000) {
            return (num / 100000).toFixed(2) + ' L';
        } else if (absNum >= 1000) {
            return (num / 1000).toFixed(2) + ' K';
        } else {
            return num.toFixed(2);
        }
    }

    function animateValue(elementId, start, end, duration) {
        const element = document.getElementById(elementId);
        const startTime = performance.now();
        const startValue = start;
        const endValue = parseFloat(element.textContent.replace(/[^0-9.-]+/g, ""));

        function update(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            const currentValue = startValue + (endValue - startValue) * progress;

            element.textContent = `₹${formatIndianCurrency(currentValue)}`;

            if (progress < 1) {
                requestAnimationFrame(update);
            }
        }

        requestAnimationFrame(update);
    }

    // Simulate live market data updates
    function updateMarketData() {
        const nifty = 22156.75 + (Math.random() - 0.5) * 100;
        const sensex = 72843.92 + (Math.random() - 0.5) * 300;
        const bankNifty = 47315.60 + (Math.random() - 0.5) * 200;
        const usdInr = 83.42 + (Math.random() - 0.5) * 0.2;

        document.getElementById('niftyValue').textContent = nifty.toFixed(2);
        document.getElementById('sensexValue').textContent = sensex.toFixed(2);
        document.getElementById('bankNiftyValue').textContent = bankNifty.toFixed(2);
        document.getElementById('usdInrValue').textContent = usdInr.toFixed(2);

        // Update change indicators
        updateChange('niftyChange', nifty > 22156.75);
        updateChange('sensexChange', sensex > 72843.92);
        updateChange('bankNiftyChange', bankNifty > 47315.60);
        updateChange('usdInrChange', usdInr > 83.42);
    }

    function updateChange(elementId, isPositive) {
        const element = document.getElementById(elementId);
        const change = (Math.random() * 1.5).toFixed(2);

        element.textContent = `${isPositive ? '+' : '-'}${change}%`;
        element.className = `market-change ${isPositive ? 'positive' : 'negative'}`;
    }

    // Initialize
    $(document).ready(function() {
        // Initialize market data
        updateMarketData();
        setInterval(updateMarketData, 5000); // Update every 5 seconds

        // Add tooltips
        $('[title]').tooltip({
            placement: 'top',
            trigger: 'hover'
        });

        // Auto-calculate when values change
        $('#buyPrice, #sellPrice, #quantity, #brokerage').on('input', function() {
            if ($('#buyPrice').val() && $('#sellPrice').val() && $('#quantity').val()) {
                setTimeout(calculateProfitLoss, 500);
            }
        });

        // Auto-update margin when values change
        $('#marginPrice, #marginQuantity, #segmentType, #marginPercent').on('input change', function() {
            if ($('#marginPrice').val() && $('#marginQuantity').val()) {
                setTimeout(calculateMargin, 500);
            }
        });

        // Initialize calculations if values exist
        if ($('#buyPrice').val() && $('#sellPrice').val() && $('#quantity').val()) {
            calculateProfitLoss();
        }
    });
</script>
@endsection
