-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: deltapsudb
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB-1:10.4.12+maria~bionic-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `static_keyword`
--

DROP TABLE IF EXISTS `static_keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `static_keyword` (
  `key_word` varchar(255) NOT NULL,
  PRIMARY KEY (`key_word`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `static_keyword`
--

LOCK TABLES `static_keyword` WRITE;
/*!40000 ALTER TABLE `static_keyword` DISABLE KEYS */;
INSERT INTO `static_keyword` VALUES ('About'),('Accept'),('add'),('Add_More_Output'),('Add_to_Compare'),('alert_text_for_read_privacy'),('All'),('All_Categories'),('All_Products'),('All_Stories'),('America'),('Applications'),('Application_Description'),('Are_your_sure_to_submit'),('Are_you_sure_to_delete_image'),('Asia'),('Be_the_first_to_hear'),('By_submitting_this_form'),('Cancel'),('catalogs'),('CC_Cv_Mode'),('CC_Mode'),('Certificates'),('City_State'),('Clear'),('Clear_All'),('Clear_Filters'),('Communication'),('Communication_description'),('Company'),('compare'),('Configurable_History'),('Configurable_Power'),('configurable_power_selector'),('Configuration_Modular_Parts'),('Confirm_Email'),('contact_Info'),('contact_us'),('Control_Code'),('Control_Code_description'),('Country'),('Created_Date'),('Customer_Model_Name'),('CV_Mode'),('Delete'),('DeltaPSU_will_use_the information_you'),('Details'),('Dimensions'),('Display_Options'),('Done'),('Downloads'),('Download_AS_PDF'),('Download_selection_guide'),('Dual_Slot'),('edit'),('Edit_List'),('Email_Address'),('End_Customer'),('Enquiry'),('Enter_email_address'),('Europe'),('Event'),('Events'),('Events&Calendar'),('Factory_Model_Name'),('FAQs'),('Featured_Products'),('find_a_distributor'),('Follow_us_on_social'),('Forgot_Password'),('General_Description'),('Get Direction'),('Get_Support'),('Global_Operations'),('GUI_Software'),('Highlights_Features'),('Home'),('If_you_need_the_frame_or_module_only'),('Image'),('Industrial_Power'),('Information'),('Inlet_Type'),('Inlet_Type_description'),('Input_Voltage'),('Installation_Manual_&_Datasheet_Download'),('instructions_to_reset_your_password'),('Item(s)_selected'),('I_have_read_and_accept'),('Latest_Article'),('Latest_News'),('Launch_Date'),('Learn_More'),('LED_Power'),('Login'),('Logout'),('Looking_for_support_for_this'),('Looking_for_support_for_this_des'),('Manual'),('Marketing_Permissions'),('Marketing_Resources'),('Marketing_Resources_Downloads'),('Mechanical_Drawing_&_3D_Drawings'),('Medical_Power'),('Message'),('Model'),('Model_Name'),('Model_Name_A-Z'),('Modifired_Date_newest_to_oldest'),('Module(s)'),('Module_Preview'),('More_Detail'),('My_Stories'),('My_Success_Stories'),('Name'),('nav_dowloads'),('Need_to_compare_other_product'),('News'),('Nomal_Logic_&_Normal_Fan_Direction'),('Nomal_Logic_&_Reversed_Fan_Direction'),('No_Event'),('Of_Outputs'),('of_slots'),('Old_Image'),('Option'),('Op_Power'),('Op_Voltage'),('Or'),('Other'),('Other_Application'),('Output_Current'),('Output_Current _low_to_high'),('Output_Power'),('Output_Power_low_to_high'),('Output_Voltage'),('Output_Voltage_low_to_high'),('Parallel_Detail'),('Partners'),('Partners_Login'),('Password'),('Phase'),('Phone_Number'),('Picture'),('Please_Select'),('Prelim_DS'),('Privacy_Policy'),('Product(s)'),('Products'),('product_comparison'),('Product_Cross_Reference'),('Product_Cross_Reference_des'),('Product_Documents'),('Product_launch_Schedule'),('Product_lists'),('Product_News'),('Product_Selector'),('Product_Type'),('Read_More'),('Related_News'),('Related_Products'),('Related_Product_Series'),('Remarks'),('Remove_Filter'),('Reset'),('Resources'),('Reversed_Logic_&_Normal_Fan_Direction'),('Reversed_Logic_&_Reversed_Fan_Direction'),('Safety_Certificates'),('Sales_kit'),('Sales_Kit_will_help_technicians'),('sales_offices'),('Save Draft'),('Search'),('Search_by_keyword'),('Search_By_Model_Name'),('Search_By_Name'),('Search_Results'),('See_All'),('See_More'),('See_Products'),('Select'),('Select_Model'),('Select_Output(s)'),('Select_Parallel'),('Select_Parallel_Connection(s)'),('Select_Product'),('Send'),('Series'),('Show_Filters'),('Sign_up_for_newsletter'),('Single_Slot'),('Slot'),('Sort_by'),('Still_have_question'),('Subject'),('Submit'),('Submitted'),('Subscribe'),('Subscribe_to_our_newsletter'),('Success_Stories'),('Summary'),('Supports'),('support_form_text'),('support_from_up_text'),('Tags'),('Technical_Articles'),('Tech_Specs'),('Terms_of_Use'),('This_is_general_information'),('Tools'),('Total_No_of_Output'),('Total_Output_Power'),('To_unsubscribe'),('Type'),('Typical_Applications'),('Unit_Weight'),('Upcoming_Event'),('Updates'),('Uploaded_on'),('View'),('View_compare'),('We_use_cookies_to_provide'),('what_type_of_support');
/*!40000 ALTER TABLE `static_keyword` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-11 10:54:07
