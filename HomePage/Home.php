{source}
<!DOCTYPE html>

    <head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="media/templates/site/cassiopeia/CustomCode/HomePage/HomeCSS.css" type="text/css" />
    </head>
    <body>

        <?php
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseTable.php';
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseQuery.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
                $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
                $select = isset($_POST['select']) ? $_POST['select'] : [];

                // Create the database query based on the filters and selection
                $Q1 = new DatabaseQuery($filters, $select);

                // Determine the current page for pagination
                $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        
                $T1 = new DatabaseTable($Q1->getQueryStatement(), $page);
                exit();
            }
        ?>

        <div class="filters">
        <button class="AllFiltersButton sidebar-button">All Filters</button>
            <p class="showText">Show in search:</p>
            <div class="selectCheckboxes">
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Website" value="Website" onclick="updateFilters()"> Website
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Geography" value="Geography" onclick="updateFilters()"> Geography
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Topic_of_Resource" value="Topic_of_Resource" onclick="updateFilters()"> Topic of Resource
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Free_or_Paid" value="Free_or_Paid" onclick="updateFilters()"> Free or Paid
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Sector" value="Sector" onclick="updateFilters()"> Sector
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" class="checkbox-item" id="Stage_of_Business" value="Stage_of_Business" onclick="updateFilters()"> Stage of Business
                    <span class="checkmarkSelect"></span>
                </label>
            </div>
        </div>
        <div>

        </div>
        <div class="Database">
            <div class="selected">
                <h1>Database Test:</h1>
                <div id="selected-filters">
                    <?php
                        $T1 = new DatabaseTable("Select Name_of_Organization, Address, Description from Resources",1);
                    ?>
                </div>
            </div>
        </div>

        <div class="overlay"></div>


    <div class="sidebar" id="mySidebar">
    <div style="display: flex;">
        <p class="filterTitle">All Filters</p>
        <img src="images/Exit-X.png#joomlaImage://local-images/Exit-X.png?width=75&height=74"  class="Exit sidebar-button">
    </div>
    
    <div class="dropbox" id="dropbox">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Free or Paid</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow FoP" onclick="toggleDropdown('dropbox','dropdown-content')" >
        </div>
            <form method="post">
                <div class="dropdown-content" id="dropdown-content">
                    <label class="checkbox-container">
                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Free" value="Free">
                        <span class="checkmark"></span>
                        Free
                    </label>
                    <label class="checkbox-container bottom">
                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Paid" value="Paid">
                        <span class="checkmark"></span>
                        Paid
                    </label>
                </div>
            </form>
      </div>
    <div class="dropbox" id="dropbox2">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Geography</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Geo" onclick="toggleDropdown('dropbox2','dropdown-content2')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content2">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="Local_North_County">
                    <span class="checkmark"></span>
                    Local North County
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_San_Deigo" value="Local_San_Deigo">
                    <span class="checkmark"></span>
                    Local San Deigo
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="California" value="California">
                    <span class="checkmark"></span>
                    California
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="National" value="National">
                    <span class="checkmark"></span>
                    National
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="International" value="International">
                    <span class="checkmark"></span>
                    International
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox3">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Stage of Business</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow SoB" onclick="toggleDropdown('dropbox3','dropdown-content3')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content3">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Ideation" value="Ideation">
                    <span class="checkmark"></span>
                    Ideation
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Seeding" value="Seeding">
                    <span class="checkmark"></span>
                    Seeding
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Establishing" value="Establishing">
                    <span class="checkmark"></span>
                    Establishing
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Growing" value="Growing">
                    <span class="checkmark"></span>
                    Growing
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Selling_Exiting" value="Selling_Exiting">
                    <span class="checkmark"></span>
                    Selling/Exiting
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox4">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Type of Business</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToB" onclick="toggleDropdown('dropbox4','dropdown-content4')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content4">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Microenterprise" value="Microenterprise">
                    <span class="checkmark"></span>
                    Microenterprise
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Innovation_Tech" value="Innovation_Tech">
                    <span class="checkmark"></span>
                    Innovation/tech
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Main_Street" value="Main_Street">
                    <span class="checkmark"></span>
                    Main Street
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Medium_Large_Business" value="Medium_Large_Business">
                    <span class="checkmark"></span>
                    Medium/Large Business
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Pop_Ups_Venders" value="Pop_Ups_Venders">
                    <span class="checkmark"></span>
                    Pop Ups/Venders
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox5">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Industry</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Ind" onclick="toggleDropdown('dropbox5','dropdown-content5')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content5">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Tech_Industry" value="Tech_Industry">
                    <span class="checkmark"></span>
                    Tech Industry
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="NonProfit_Social_Sector" value="NonProfit_Social_Sector">
                    <span class="checkmark"></span>
                    Non-profit social sector
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Agricultural_Sector" value="Agricultural_Sector">
                    <span class="checkmark"></span>
                    Agricultural sector
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Consumer_Goods_Retail" value="Consumer_Goods_Retail">
                    <span class="checkmark"></span>
                    Consumer goods/retail
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Entertainment" value="Entertainment">
                    <span class="checkmark"></span>
                    Entertainment
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Other_Indusrty" value="Other_Indusrty">
                    <span class="checkmark"></span>
                    Other Indusrty
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox6">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Sector</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Sec" onclick="toggleDropdown('dropbox6','dropdown-content6')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content6">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Veteran" value="Veteran">
                    <span class="checkmark"></span>
                    Veteran
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Women" value="Women">
                    <span class="checkmark"></span>
                    Women
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="People_With_Disabilities" value="People_With_Disabilities">
                    <span class="checkmark"></span>
                    People with Disabilities
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Multicultural" value="Multicultural">
                    <span class="checkmark"></span>
                    Multicultural
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Black" value="Black">
                    <span class="checkmark"></span>
                    Black
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Asian" value="Asian">
                    <span class="checkmark"></span>
                    Asian
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Latin_X" value="Latin_X">
                    <span class="checkmark"></span>
                    Latin X
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Immigrants" value="Immigrants">
                    <span class="checkmark"></span>
                    Immigrants
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Under_Privileged" value="Under_Privileged">
                    <span class="checkmark"></span>
                    Under privileged (low income)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="LGBTQ" value="LGBTQ">
                    <span class="checkmark"></span>
                    LGBTQ+
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Veteran_Women" value="Veteran_Women">
                    <span class="checkmark"></span>
                    Veteran Women
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Student" value="Student">
                    <span class="checkmark"></span>
                    Student
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox7">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Type of Resources</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToR" onclick="toggleDropdown('dropbox7','dropdown-content7')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content7">
                <div class="filter-option">
                <label class="checkbox-container" >
                    <input type="checkbox" id="main-checkbox1" name="filters[]" class="checkbox-item" id="Funding" value="Funding">
                    Funding
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown1">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Venture_Capital" value="Funding_Venture_Capital"> Funding Venture Capital
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Private_Equity_Firms" value="Private_Equity_Firms"> Private Equity Firms
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Angel" value="Funding_Angel"> Funding Angel
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Grants" value="Funding_Grants"> Funding Grants
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Loans" value="Funding_Loans"> Funding Loans
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Crowfunding" value="Crowfunding"> Crowfunding
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Microcredit_Microloans" value="Microcredit_Microloans"> Microcredit/Microloans 
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Other_Funding" value="Other_Funding"> Other funding
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox2" name="filters[]" class="checkbox-item" id="Financial_Information" value="Financial_Information">
                    Financial Information
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown2">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Investment_Advisor" value="Investment_Advisor"> Investment Advisor
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Education_FL_BP_BC" value="Education_FL_BP_BC"> Education: Financial Literacy, Business Plans, Business Cards
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Wealth_Managment" value="Wealth_Managment"> Wealth Managment
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Accounting_Assistance" value="Accounting_Assistance"> Accounting Assistance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Banking" value="Banking"> Banking
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox3" name="filters[]" class="checkbox-item" id="Networking" value="Networking">
                    Networking
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown3">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Meetups" value="Meetups"> Meetups
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Networking_Two" value="Networking_Two"> Networking
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox4" name="filters[]" class="checkbox-item" id="Incubator_Accelerator" value="Incubator_Accelerator">
                    Incubator/Accelerator
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown4">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Accelerator" value="Accelerator"> Accelerator
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Incubator" value="Incubator"> Incubator
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox5" name="filters[]" class="checkbox-item" id="Mentorship" value="Mentorship">
                    Mentorship
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown5">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Mentoring" value="Mentoring"> Mentoring
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Startup_Advisor" value="Startup_Advisor"> Startup Advisor
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Business_Counseling" value="Business_Counseling"> Business Counseling
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox6" name="filters[]" class="checkbox-item" id="Educational_Training" value="Educational_Training">
                    Educational/Training
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown6">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Training" value="Training"> Training
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Article" value="Article"> Article
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Education" value="Education"> Education
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox7" name="filters[]" class="checkbox-item" id="Tech_Assistance" value="Tech_Assistance">
                    Tech Assistance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown7">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Tech_Assistance" value="Tech_Help"> Tech Help
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Project_Management_Software" value="Project_Management_Software"> Project Management Software
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Website_Assistance" value="Website_Assistance"> Website Assistance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Software" value="Software"> Software
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Mobile_n_Web_App_Development" value="Mobile_n_Web_App_Development"> Mobile & Web App Development
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Mobile_Form_Development" value="Mobile_Form_Development"> Mobile Form Development
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Cyber_Security" value="Cyber_Security"> Cyber Security
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Website_Builder" value="Website_Builder"> Website Builder
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Software_Development" value="Software_Development"> Software Development
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox8" name="filters[]" class="checkbox-item" id="General_Business_Assistance" value="General_Business_Assistance">
                    General Business Assistance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown8">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Mental_Health" value="Mental_Health"> Mental Health
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Hiring_Assistance" value="Hiring_Assistance"> Hiring Assistance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Work_Space" value="Work_Space"> Work Space
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="CRO" value="CRO"> CRO
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Insurance" value="Insurance"> Insurance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="General_Business_Assistance_Services" value="General_Business_Assistance_Services"> General Business Assistance/Services
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Marketing" value="Marketing"> Marketing
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Supply_Chain" value="Supply_Chain"> Supply Chain
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Consulting" value="Consulting"> Consulting
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Commercialization_and_Marketplaces" value="Commercialization_and_Marketplaces"> Commercialization and Marketplaces
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Certification" value="Certification"> Certification
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox9" name="filters[]" class="checkbox-item" id="Legal_Assistance" value="Legal_Assistance">
                    Legal Assistance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown9">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="General_Legal_Assistance" value="General_Legal_Assistance"> General Legal Assistance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Legal_Assistance_IP_TM_P" value="Legal_Assistance_IP_TM_P"> Legal Assistance: Intelectual property, Trade marks, Patents
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Legal_Assistance_Legal_Formation" value="Legal_Assistance_Legal_Formation"> Legal Assistance: Legal Formation
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
            </div>
        </form>
    </div>
    
    </div>

    </body>
    <script src="media/templates/site/cassiopeia/CustomCode/HomePage/HomeJS.js" type="text/javascript"></script>
</html>
{/source}