<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>
    <header>
        <div class="logo-container">
             <h1>DocFlow</h1>
        </div>
        <nav class="navbar">
            <ul class="navbar-menu-list">
                <li class="navbar-menu"><a href="pm-letters.html">Project Management Letters</a></li>
                <span>|</span>
                <li class="navbar-menu"><a href="legal-letters.html">Legal Letters</a></li>
                <span>|</span>
                <li class="navbar-menu"><a href="hr-letters.html">HR Letters</a></li>
                <span>|</span>
                <li class="navbar-menu"><a href="scm-letters.html">Supply Chain Management Letters</a></li>
            </ul>
            <div class="navbar-btns">
                <button class="login-btn"><a href="../login.html">Login</a></button>
            </div>
        </nav>
    </header>
    <main id="dashboard-page-content">
        <section id="dashboard-section">
            <nav id="side-navbar">
                <div class="side-navbar-menu" id="dashboard">
                    <img src="../images/home.png">
                    <p>Dashboard</p>
                </div>
                <div class="side-navbar-menu" id="documents">
                    <img src="../images/file.png">
                    <p>Documents</p>
                </div>
                <div class="side-navbar-menu" id="templates">
                    <img src="../images/write.png">
                    <p>Templates</p>
                </div>
                <div class="side-navbar-menu" id="authorization">
                    <img src="../images/loa.png">
                    <p>LOAs</p>
                </div>
                <div class="side-navbar-menu" id="contracts">
                    <img src="../images/contract.png">
                    <p>GCC Contracts</p>
                </div>
                <div class="side-navbar-menu" id="correspondence">
                    <img src="../images/business.png">
                    <p>Correspondence</p>
                </div>
                <div class="side-navbar-menu" id="client">
                    <img src="../images/customers.png">
                    <p>Client</p>
                </div>
                <div class="side-navbar-menu" id="branding">
                    <img src="../images/branding.png">
                    <p>Branding</p>
                </div>
            </nav>
        </section>
        <div id="content"></div>
    </main>

    <script src="../script.js"></script>
    <script src="../scripts/generate-new.js"></script>
</body>
</html>