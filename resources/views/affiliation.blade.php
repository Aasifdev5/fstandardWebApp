@extends('user-master')
@section('title', 'My Affiliation')

@section('content')
<h2 class="mb-4 text-white fw-bold">My Affiliation</h2>
<div class="card p-5 text-center">
    <i class="fa-solid fa-users fa-4x text-muted mb-3"></i>
    <h4 class="text-white">No referrals yet</h4>
    <p class="text-muted">Invite friends and earn rewards!</p>
    <button class="btn btn-primary-custom mt-3 px-4 py-2">Copy Referral Link</button>
</div>
@endsection
