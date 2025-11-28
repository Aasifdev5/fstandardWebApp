@extends('master')

@section('title', __('Panel'))

@section('content')


  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root {
      --primary: #ff8c00;
      --primary-light: #ffb347;
      --primary-dark: #e67e00;
      --secondary: #6c757d;
      --success: #28a745;
      --info: #17a2b8;
      --warning: #ffc107;
      --danger: #dc3545;
      --light: #f8f9fa;
      --dark: #343a40;
      --gray: #6c757d;
      --gray-light: #e9ecef;
      --white: #ffffff;
      --body-bg: #f5f7fb;
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --sidebar-width: 260px;
    }

    body {
      background: var(--body-bg);
      font-family: 'Inter', 'Segoe UI', sans-serif;
      color: #333;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      width: var(--sidebar-width);
      height: 100vh;
      background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
      padding: 25px 15px;
      position: fixed;
      top: 0;
      left: 0;
      color: var(--white);
      z-index: 1000;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .sidebar-logo {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: -10px;
      margin-top: -30px;
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 0 10px;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 15px;
      padding: 12px 15px;
      cursor: pointer;
      border-radius: 10px;
      margin-bottom: 8px;
      color: var(--white);
      transition: all 0.3s;
      font-weight: 500;
    }

    .menu-item:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateX(5px);
    }

    .menu-item.active {
      background: rgba(255, 255, 255, 0.25);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .menu-item i {
      width: 20px;
      text-align: center;
    }

    /* Main Content */
    .main-wrapper {
      max-width: 1300px;
      margin: 0 auto;
      padding: 35px 30px;
    }

    .content {
      margin-left: var(--sidebar-width);
      transition: all 0.3s ease;
    }

    .content.expanded {
      margin-left: 0;
    }

    /* Cards */
    .card {
      border-radius: 16px;
      border: none;
      background: var(--white);
      box-shadow: var(--card-shadow);
      transition: transform 0.3s, box-shadow 0.3s;
      overflow: hidden;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .card-header {
      background: transparent;
      border-bottom: 1px solid var(--gray-light);
      padding: 20px 25px 10px;
      font-weight: 600;
    }

    .card-body {
      padding: 20px 25px;
    }

    /* Progress Bar */
    .progress {
      height: 8px;
      border-radius: 10px;
      background-color: var(--gray-light);
    }

    .progress-bar-orange {
      background: linear-gradient(to right, var(--primary-light), var(--primary));
      border-radius: 10px;
    }

    /* Tags */
    .tag-warning {
      background: #fff3cd;
      padding: 8px 15px;
      border-radius: 8px;
      color: #856404;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
    }

    .tag-success {
      background: #d1edff;
      padding: 8px 15px;
      border-radius: 8px;
      color: #0c5460;
      font-size: 14px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 500;
    }

    /* Metrics */
    .metric-card {
      text-align: center;
      padding: 20px 15px;
    }

    .metric-value {
      font-size: 32px;
      font-weight: 700;
      color: var(--primary);
      margin: 10px 0;
    }

    .metric-label {
      font-size: 14px;
      color: var(--gray);
    }

    /* Chart Container */
    .chart-container {
      position: relative;
      height: 240px;
      width: 100%;
    }

    /* Page Content */
    .page-content {
      display: none;
    }

    .page-content.active {
      display: block;
    }

    /* Header */
    .page-header {
      display: flex;
      justify-content: between;
      align-items: center;
      margin-bottom: 30px;
    }

    .page-title {
      font-weight: 700;
      color: var(--dark);
      margin: 0;
    }

    /* Mobile Adjustments */
    @media (max-width: 992px) {
      .sidebar {
        left: calc(-1 * var(--sidebar-width));
      }
      .sidebar.show {
        left: 0;
      }
      .menu-btn {
        display: block !important;
        margin-bottom: 20px;
        z-index: 1001;
        position: fixed;
        top: 20px;
        left: 20px;
        background: var(--primary);
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      }
      .content {
        margin-left: 0 !important;
      }
      .main-wrapper {
        padding: 60px 20px 30px;
      }
    }

    .menu-btn {
      display: none;
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s;
    }

    /* Stats Grid */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 20px;
      margin-bottom: 30px;
    }

    /* Table Styling */
    .table-modern {
      border-radius: 12px;
      overflow: hidden;
      box-shadow: var(--card-shadow);
    }

    .table-modern thead th {
      background-color: var(--primary);
      color: white;
      border: none;
      padding: 15px;
      font-weight: 600;
    }

    .table-modern tbody td {
      padding: 15px;
      border-bottom: 1px solid var(--gray-light);
    }

    .table-modern tbody tr:last-child td {
      border-bottom: none;
    }

    /* Button Styling */
    .btn-primary-custom {
      background: var(--primary);
      border: none;
      border-radius: 10px;
      padding: 10px 20px;
      font-weight: 500;
      transition: all 0.3s;
    }

    .btn-primary-custom:hover {
      background: var(--primary-dark);
      transform: translateY(-2px);
      box-shadow: 0 4px 10px rgba(255, 140, 0, 0.3);
    }

    /* Alert Styling */
    .alert-modern {
      border-radius: 12px;
      border: none;
      padding: 15px 20px;
      margin-bottom: 20px;
    }

    /* Form Styling */
    .form-control-modern {
      border-radius: 10px;
      border: 1px solid var(--gray-light);
      padding: 12px 15px;
      transition: all 0.3s;
    }

    .form-control-modern:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.25);
    }
  </style>


<!-- SIDEBAR -->
<div class="sidebar">
  <a href="{{ url('/') }}" class="text-white text-decoration-none">
  <div class="sidebar-logo">
    <img src="{{ asset('dlogo.png') }}" alt="">

  </div>
</a>


  <div class="menu-item active" data-page="overview"><i class="fa-solid fa-chart-line"></i> Progress</div>
  <div class="menu-item" data-page="rules"><i class="fa-solid fa-book"></i> Manage Orders</div>
  <div class="menu-item" data-page="accounts"><i class="fa-solid fa-user"></i> Trade History</div>
  <div class="menu-item" ><i class="fa-solid fa-wallet"></i> Deposit History</div>
  <div class="menu-item" data-page="withdrawals"><i class="fa-solid fa-wallet"></i> Withdraw History</div>
  <div class="menu-item" data-page="kyc"><i class="fa-solid fa-id-card"></i> KYC</div>
  {{-- <div class="menu-item" data-page="offers"><i class="fa-solid fa-gift"></i> Offers</div> --}}
  <div class="menu-item" data-page="referrals"><i class="fa-solid fa-people-group"></i> My Affiliation</div>
  <div class="menu-item" data-page="faq"><i class="fa-solid fa-circle-question"></i> Calculator</div>
  <div class="menu-item" data-page="contact"><i class="fa-solid fa-envelope"></i> Transaction History</div>
  <div class="menu-item" data-page="calculators"><i class="fa-solid fa-calculator"></i> Get Support</div>
 <div class="menu-item"
     style="cursor:pointer; color:#fff; padding:12px 16px; display:flex; align-items:center; gap:10px; border-radius:8px; transition:0.3s;"
     onmouseover="this.style.background='rgba(255,255,255,0.15)'; this.children[0].style.transform='rotate(-10deg)';"
     onmouseout="this.style.background='transparent'; this.children[0].style.transform='rotate(0deg)';"
     onclick="window.location='{{ url('logout') }}'">

    <i class="fa-solid fa-right-from-bracket"
       style="font-size:18px; transition:0.3s;"></i>

    Logout
</div>



</div>

<!-- MAIN CONTENT -->
<div class="content">
  <div class="main-wrapper">
    <i class="fa-solid fa-bars menu-btn"></i>

    <!-- OVERVIEW PAGE -->
    <div class="page-content active" id="overview">
          <h1>Welcome {{ $user_session->name }}</h1>
        <br>
      <div class="page-header">

        <h3 class="page-title">Overview</h3>

      </div>

      <!-- Stats Grid -->
      <div class="stats-grid">
        <div class="card metric-card">
          <div class="metric-label">Balance</div>
          <div class="metric-value">$10,881.50</div>
          <div class="progress mt-2">
            <div class="progress-bar-orange" style="width: 75%;"></div>
          </div>
          <small class="text-muted">75% of $100K Tier</small>
        </div>

        <div class="card metric-card">
          <div class="metric-label">Consistency</div>
          <div class="metric-value">90%</div>
          <div class="mt-2">
            <span class="tag-success"><i class="fa-solid fa-check"></i> Excellent</span>
          </div>
        </div>

        <div class="card metric-card">
          <div class="metric-label">Daily ZD</div>
          <div class="metric-value">7%</div>
          <div class="mt-2">
            <small class="text-muted">5 days left</small>
          </div>
        </div>

        <div class="card metric-card">
          <div class="metric-label">Active Alerts</div>
          <div class="metric-value">3</div>
          <div class="mt-2">
            <span class="tag-warning"><i class="fa-solid fa-exclamation-triangle"></i> Attention</span>
          </div>
        </div>
      </div>

      <!-- Chart and Metrics Row -->
      <div class="row mb-4">
        <div class="col-lg-8 mb-4">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <span>Equity Growth</span>
              <div class="btn-group btn-group-sm">
                <button class="btn btn-outline-secondary active">1M</button>
                <button class="btn btn-outline-secondary">3M</button>
                <button class="btn btn-outline-secondary">6M</button>
                <button class="btn btn-outline-secondary">1Y</button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="equityChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <span>Account Metrics</span>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Max Drawdown</span>
                  <strong>4.2%</strong>
                </div>
                <div class="progress mt-1">
                  <div class="progress-bar-orange" style="width: 42%;"></div>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Profit Target</span>
                  <strong>78%</strong>
                </div>
                <div class="progress mt-1">
                  <div class="progress-bar-orange" style="width: 78%;"></div>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Daily Loss</span>
                  <strong>22%</strong>
                </div>
                <div class="progress mt-1">
                  <div class="progress-bar-orange" style="width: 22%;"></div>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Risk per Trade</span>
                  <strong>3.5%</strong>
                </div>
                <div class="progress mt-1">
                  <div class="progress-bar-orange" style="width: 70%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Alerts and Rules Row -->
      <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <span>Recent Alerts</span>
            </div>
            <div class="card-body">
              <div class="alert alert-warning alert-modern d-flex align-items-center">
                <i class="fa-solid fa-exclamation-triangle me-3 fs-5"></i>
                <div>
                  <strong>Too much risk detected!</strong>
                  <div class="small">October 20, 2023</div>
                </div>
              </div>
              <div class="alert alert-info alert-modern d-flex align-items-center">
                <i class="fa-solid fa-info-circle me-3 fs-5"></i>
                <div>
                  <strong>5 days left for target</strong>
                  <div class="small">October 18, 2023</div>
                </div>
              </div>
              <div class="alert alert-success alert-modern d-flex align-items-center">
                <i class="fa-solid fa-check-circle me-3 fs-5"></i>
                <div>
                  <strong>Daily target achieved</strong>
                  <div class="small">October 15, 2023</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <span>Trading Rules</span>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Max Drawdown</span>
                  <strong>20%</strong>
                </div>
                <div class="small text-muted">Maximum allowed drawdown</div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Risk per Trade</span>
                  <strong>5%</strong>
                </div>
                <div class="small text-muted">Maximum risk per single trade</div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Consistency Cap</span>
                  <strong>25%</strong>
                </div>
                <div class="small text-muted">Consistency calculation limit</div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Lot Band</span>
                  <strong>0.77%</strong>
                </div>
                <div class="small text-muted">Allowed lot size variation</div>
              </div>
              <div class="mb-0">
                <div class="d-flex justify-content-between">
                  <span>Inactivity</span>
                  <strong>10 days</strong>
                </div>
                <div class="small text-muted">Maximum allowed inactivity period</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- RULES PAGE -->
    <div class="page-content" id="rules">
      <div class="page-header">
        <h3 class="page-title">Trading Rules</h3>
        <button class="btn btn-primary-custom"><i class="fa-solid fa-file-pdf"></i> Download PDF</button>
      </div>

      <div class="row">
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-header">
              <span>General Rules</span>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <h5>Drawdown Rules</h5>
                <p>Maximum allowed drawdown is 20% of your initial balance. This includes both floating and realized losses.</p>
                <div class="alert alert-warning alert-modern">
                  <i class="fa-solid fa-exclamation-triangle me-2"></i>
                  Exceeding the maximum drawdown will result in account termination.
                </div>
              </div>

              <div class="mb-4">
                <h5>Risk Management</h5>
                <p>You must not risk more than 5% of your account balance on any single trade. This helps protect your capital from significant losses.</p>
              </div>

              <div class="mb-4">
                <h5>Consistency Rules</h5>
                <p>Your trading consistency should not exceed 25% variance between your most profitable and least profitable days.</p>
              </div>

              <div class="mb-0">
                <h5>Lot Size Rules</h5>
                <p>Maximum allowed lot size variation is 0.77% of your account balance per trade.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-header">
              <span>Rule Summary</span>
            </div>
            <div class="card-body">
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Max Drawdown</span>
                  <strong>20%</strong>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Risk per Trade</span>
                  <strong>5%</strong>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Consistency Cap</span>
                  <strong>25%</strong>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Lot Band</span>
                  <strong>0.77%</strong>
                </div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between">
                  <span>Inactivity</span>
                  <strong>10 days</strong>
                </div>
              </div>
              <div class="mb-0">
                <div class="d-flex justify-content-between">
                  <span>Profit Target</span>
                  <strong>8%</strong>
                </div>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="card-header">
              <span>Need Help?</span>
            </div>
            <div class="card-body">
              <p>If you have questions about any trading rules, contact our support team.</p>
              <button class="btn btn-primary-custom w-100"><i class="fa-solid fa-headset"></i> Contact Support</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ACCOUNTS PAGE -->
    <div class="page-content" id="accounts">
      <div class="page-header">
        <h3 class="page-title">Account Management</h3>
        <button class="btn btn-primary-custom"><i class="fa-solid fa-plus"></i> New Account</button>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header">
              <span>Your Accounts</span>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-modern table-hover mb-0">
                  <thead>
                    <tr>
                      <th>Account ID</th>
                      <th>Balance</th>
                      <th>Equity</th>
                      <th>Profit</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#783429</td>
                      <td>$10,881.50</td>
                      <td>$11,245.30</td>
                      <td class="text-success">+$363.80</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#783428</td>
                      <td>$5,000.00</td>
                      <td>$4,872.15</td>
                      <td class="text-danger">-$127.85</td>
                      <td><span class="badge bg-warning">Pending</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                      </td>
                    </tr>
                    <tr>
                      <td>#783427</td>
                      <td>$25,000.00</td>
                      <td>$26,542.80</td>
                      <td class="text-success">+$1,542.80</td>
                      <td><span class="badge bg-success">Active</span></td>
                      <td>
                        <button class="btn btn-sm btn-outline-primary">View</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <span>Account Performance</span>
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="accountPerformanceChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="card-header">
              <span>Quick Actions</span>
            </div>
            <div class="card-body">
              <div class="d-grid gap-2">
                <button class="btn btn-primary-custom"><i class="fa-solid fa-plus"></i> Create New Account</button>
                <button class="btn btn-outline-primary"><i class="fa-solid fa-sync"></i> Refresh Accounts</button>
                <button class="btn btn-outline-primary"><i class="fa-solid fa-download"></i> Export Statements</button>
                <button class="btn btn-outline-primary"><i class="fa-solid fa-cog"></i> Account Settings</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Other pages would follow similar structure -->
    <!-- Placeholder for other pages -->
    <div class="page-content" id="withdrawals">
      <div class="page-header">
        <h3 class="page-title">Withdrawals</h3>
        <button class="btn btn-primary-custom"><i class="fa-solid fa-plus"></i> New Withdrawal</button>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-wallet fs-1 text-muted mb-3"></i>
          <h4>Withdrawals Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>

    <div class="page-content" id="kyc">
      <div class="page-header">
        <h3 class="page-title">KYC Verification</h3>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-id-card fs-1 text-muted mb-3"></i>
          <h4>KYC Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>

    <!-- CONTACT PAGE -->
    <div class="page-content" id="contact">
      <div class="page-header">
        <h3 class="page-title">Contact Support</h3>
      </div>

      <div class="row">
        <div class="col-lg-8 mb-4">
          <div class="card">
            <div class="card-header">
              <span>Send us a Message</span>
            </div>
            <div class="card-body">
              <form>
                <div class="mb-3">
                  <label class="form-label">Subject</label>
                  <input type="text" class="form-control form-control-modern" placeholder="Enter subject">
                </div>
                <div class="mb-3">
                  <label class="form-label">Message</label>
                  <textarea class="form-control form-control-modern" rows="5" placeholder="Enter your message"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Attachment</label>
                  <input type="file" class="form-control form-control-modern">
                </div>
                <button type="submit" class="btn btn-primary-custom">Send Message</button>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-4 mb-4">
          <div class="card">
            <div class="card-header">
              <span>Contact Information</span>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <h6>Email Support</h6>
                <p class="text-muted mb-1">support@fstandard.in</p>
                <small>Average response time: 2 hours</small>
              </div>
              <div class="mb-4">
                <h6>Customer Care</h6>
                <p class="text-muted mb-1">+91 99999 99999</p>
                <small>Available 24/7</small>
              </div>
              <div class="mb-4">
                <h6>WhatsApp</h6>
                <p class="text-muted mb-1">+91 99999 99989</p>
                <small>Quick responses</small>
              </div>
              <div class="mb-0">
                <h6>Tickets</h6>
                <p class="text-muted mb-1">Real-time updates</p>
                <small>Track your requests</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Other placeholder pages -->
    <div class="page-content" id="offers">
      <div class="page-header">
        <h3 class="page-title">Special Offers</h3>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-gift fs-1 text-muted mb-3"></i>
          <h4>Offers Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>

    <div class="page-content" id="referrals">
      <div class="page-header">
        <h3 class="page-title">Referral Program</h3>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-people-group fs-1 text-muted mb-3"></i>
          <h4>Referrals Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>

    <div class="page-content" id="faq">
      <div class="page-header">
        <h3 class="page-title">Frequently Asked Questions</h3>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-circle-question fs-1 text-muted mb-3"></i>
          <h4>FAQ Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>

    <div class="page-content" id="calculators">
      <div class="page-header">
        <h3 class="page-title">Trading Calculators</h3>
      </div>
      <div class="card">
        <div class="card-body text-center py-5">
          <i class="fa-solid fa-calculator fs-1 text-muted mb-3"></i>
          <h4>Calculators Page</h4>
          <p class="text-muted">This page is under development</p>
        </div>
      </div>
    </div>



  </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  // Toggle sidebar on mobile
  $(".menu-btn").click(() => {
    $(".sidebar").toggleClass("show");
    $(".content").toggleClass("expanded");
  });

  // Page navigation
  $(".menu-item").click(function() {
    // Update active menu item
    $(".menu-item").removeClass("active");
    $(this).addClass("active");

    // Show selected page
    const pageId = $(this).data("page");
    $(".page-content").removeClass("active");
    $("#" + pageId).addClass("active");

    // Close sidebar on mobile after selection
    if ($(window).width() < 992) {
      $(".sidebar").removeClass("show");
      $(".content").removeClass("expanded");
    }
  });

  // Equity Chart
  new Chart(document.getElementById("equityChart"), {
    type: "line",
    data: {
      labels: Array.from({length:30}, (_,i) => `Day ${i+1}`),
      datasets: [{
        data: [10000, 10200, 10150, 10300, 10500, 10700, 10650, 10800, 11000, 11200,
               11150, 11300, 11500, 11700, 11650, 11800, 12000, 11850, 11900, 12050,
               12200, 12150, 12300, 12400, 12500, 12450, 12550, 12600, 12700, 12881],
        borderColor: "#ff8c00",
        backgroundColor: "rgba(255, 140, 0, 0.1)",
        borderWidth: 3,
        tension: 0.4,
        pointRadius: 0,
        fill: true
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          mode: 'index',
          intersect: false
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: { maxTicksLimit: 8 }
        },
        y: {
          grid: { color: "rgba(0,0,0,0.05)" },
          beginAtZero: false
        }
      }
    }
  });

  // Account Performance Chart
  new Chart(document.getElementById("accountPerformanceChart"), {
    type: "bar",
    data: {
      labels: ['Account #783429', 'Account #783428', 'Account #783427'],
      datasets: [{
        label: 'Profit/Loss',
        data: [363.80, -127.85, 1542.80],
        backgroundColor: [
          'rgba(255, 140, 0, 0.7)',
          'rgba(220, 53, 69, 0.7)',
          'rgba(255, 140, 0, 0.7)'
        ],
        borderColor: [
          'rgb(255, 140, 0)',
          'rgb(220, 53, 69)',
          'rgb(255, 140, 0)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          grid: {
            color: "rgba(0,0,0,0.05)"
          }
        },
        x: {
          grid: {
            display: false
          }
        }
      }
    }
  });
</script>

@endsection
