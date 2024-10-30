<?php
class DatabaseQuery{
    public $isWhere = false;
    public $oldGroup = "";
    public $isdifferent = false;
    public $isToR = false;
    public $whereData = [];
    public $selectData = [];
    public $queryStatement = "Select Name_of_organization, Address, Description";
    public $checkBoxValues = ["Free" => "FoP","Paid" => "FoP",
                                "Local_North_County" => "Geo", "Local_San_Deigo" => "Geo", "California" => "Geo", "National" => "Geo", "International" => "Geo",
                                "Ideation" => "SoB", "Seeding" => "SoB", "Establishing" => "SoB", "Growing" => "SoB", "Selling_Exiting" => "SoB",
                                "Microenterprise" => "ToB", "Innovation_Tech" => "ToB", "Main_Street" => "ToB", "Medium_Large_Business" => "ToB", "Pop_Ups_Vendors" => "ToB",
                                "Tech_Industry" => "Ind", "NonProfit_Social_Sector" => "Ind", "Agricultural_Sector" => "Ind", "Consumer_Goods_Retail" => "Ind", "Entertainment" => "Ind", "Other_Industry" => "Ind",
                                "Veteran" => "Sec", "Women" => "Sec", "People_With_Disabilities" => "Sec", "Multicultural" => "Sec", "Black" => "Sec", "Asian" => "Sec", "Latin_X" => "Sec", "Immigrants" => "Sec", "Under_Privileged" => "Sec", "LGBTQ" => "Sec", "Veteran_Women" => "Sec", "Student" => "Sec",
                                "Funding" => "ToRF", "Funding_Venture_Capital" => "ToR", "Private_Equity_Firms" => "ToR", "Funding_Angel" => "ToR", "Funding_Grants" => "ToR", "Funding_Loans" => "ToR", "Crowdfunding" => "ToR", "Microcredit_MicroLoans" => "ToR", "Other_Funding" => "ToR", 
                                "Finacial_Information" => "ToRF", "Investment_Advisor" => "ToR", "Education_FL_BP_BC" => "ToR", "Wealth_Managment" => "ToR", "Accounting_Assistance" => "ToR", "Banking" => "ToR", 
                                "Networking" => "ToRF", "Meetups" => "ToR", "Networking_Two" => "ToR", 
                                "Incubator_Accelerator" => "ToRF", "Accelerator" => "ToR", "Incubator" => "ToR", 
                                "Mentorship" => "ToRF", "Mentoring" => "ToR", "Startup_Advisor" => "ToR", "Business_Counseling" => "ToR", 
                                "Educational_Training" => "ToRF", "Training" => "ToR", "Article" => "ToR", "Education" => "ToR", 
                                "Tech_Assistance" => "ToRF", "Tech_Help" => "ToR", "Project_Managment_Software" => "ToR", "Website_Assistance" => "ToR", "Software" => "ToR", "Mobile_n_Web_App_Development" => "ToR", "Mobile_Form_Development" => "ToR", "Cyber_Security" => "ToR", "Website_Builder" => "ToR", "Software_Development" => "ToR", 
                                "General_Business_Assistance" => "ToRF", "Mental_Health" => "ToR", "Hiring_Assistance" => "ToR", "Work_Space" => "ToR", "CRO" => "ToR", "Insurance" => "ToR", "General_Business_Assistance_Services" => "ToR", "Marketing" => "ToR", "Supply_Chain" => "ToR", "Consulting" => "ToR", "Commercialization_and_Marketplaces" => "ToR", "Certification" => "ToR", 
                                "Legal_Assistance" => "ToRF", "General_Legal_Assistance" => "ToR", "Legal_Assistance_IP_TM_P" => "ToR", "Legal_Assistance_Legal_Formation"
                            ];
//switch ToRF to a single 
    public function __construct($filters,$selected){
        $this->whereData = $filters;
        $this->selectData = $selected;
        $this->addSelect();
        $this->whereSetUp();
    }

    public function getQueryStatement(){
        return $this->queryStatement;
    }

    public function addSelect(){
        foreach($this->selectData as $selected){
            $this->queryStatement .= "," . $selected;
        }
        $this->queryStatement .= " from Resources ";
    }

    public function addWhere($addition){
        if(!($this->isWhere)){
            $this->queryStatement .= "where (";
        }elseif($this->isdifferent){
            $this->queryStatement .= ") AND (";
        }elseif($this->isToR){
            $this->queryStatement .= ") OR (";
        }
        else{
            $this->queryStatement .= " OR ";
        }
        $this->queryStatement .= $addition;
    }

    public function whereSetUp(){
        foreach($this->checkBoxValues as $value => $group){
            if(in_array($value,$this->whereData)){
                if(!($this->isWhere)){
                    $this->oldGroup = $group;
                }elseif($this->oldGroup != $group){
                    $this->isdifferent = true;
                    if(0==strcasecmp($this->oldGroup, "ToR")){
                        $this->isdifferent = false;
                        $this->isToR = true;
                    }
                    $this->oldGroup = $group;
                }elseif(0==strcasecmp($this->oldGroup, "ToRF")){
                    $this->isToR = true;
                }
                $this->addWhere($value . " = 1");
                $this->isWhere = True;
                $this->isdifferent = false;
            }
        }
        if($this->isWhere){
            $this->queryStatement .= ")";
        }
    }


};
?>