//Need library files imported
import { Component, OnInit, ElementRef } from "@angular/core";
import { ProductService } from "../../../services/product.service";
import { ServerCallService } from "../../../services/server-call.service";
import {
  FormGroup,
  FormControl,
  Validators,
  FormArray,
  ValidatorFn,
} from "@angular/forms";
import { Router } from "@angular/router";
import { Configurations } from "../../../config/configurations";

import { BlockUI, NgBlockUI } from "ng-block-ui";
import Swal from "sweetalert2";
import * as jspdf from "jspdf";
import html2canvas from "html2canvas";
import { ValidationService } from "src/app/services/validation.service";
import { ModalService } from "../../../modal";

//Specifid the this component schema
@Component({
  selector: "app-user",
  templateUrl: "./user.component.html",
  styleUrls: ["./user.component.css"],
})

//Class implmentation for this component
export class UserComponent implements OnInit {
  @BlockUI() blockUI: NgBlockUI;

  //Variable decrlation with its type
  loggedProfile: any;
  applications: any;
  source: any;
  serverRequest: any;
  serverResponse: any;
  errorMsg: string;
  action: string;
  userMsg: string;
  presentFormNo: number;
  firstContactValues: any;
  briefAssesmentValues: any;
  detailedPresentationValues: any;
  finalApproval: any;
  selectedApplication: number;
  currentStatus: string;
  firstContactFormClose: string;
  briefAssesmentFormClose: string;
  detailedPresentationFormClose: string;
  finalApprovalFormClose: string;
  firstContactFormSelector: any;
  briefAssesmentFormSelector: any;
  detailedPresentationFormSelector: any;
  firstContactCompleted: number;
  briefAssesmentCompleted: number;
  detailedPresentationCompleted: number;
  finalApprovalCompleted: number;
  loader: string;
  emailId: string;
  profileImg: any;
  initialPresentForm: number;
  modelFeedback: any;
  feedBackUserSelector: any;
  countries: any;
  faq: any;

  //Files Size Allowed
  maxAllowedSize = Configurations.MAX_FILE_UPLOAD_SIZE;

  //Files Accepet Types
  fileTypes = Configurations.FILE_UPLOAD_ACCEPET_TYPES;

  //Profile Image Files Accepet Types
  profileImgFileTypes = Configurations.PROFILE_IMG_UPLOAD_ACCEPET_TYPES;

  //Breaf assesment files
  uploadFiles_2_0: string[] = [];
  uploadFiles_2_1: string[] = [];
  uploadFiles_2_2: string[] = [];
  uploadFiles_2_3: string[] = [];
  uploadFiles_2_4: string[] = [];
  uploadFiles_2_5: string[] = [];
  uploadFiles_2_6: string[] = [];
  uploadFiles_2_7: string[] = [];
  uploadFiles_2_8: string[] = [];
  uploadFiles_2_9: string[] = [];

  uploadFiles_2_0Len = 0;
  uploadFiles_2_1Len = 0;
  uploadFiles_2_2Len = 0;
  uploadFiles_2_3Len = 0;
  uploadFiles_2_4Len = 0;
  uploadFiles_2_5Len = 0;
  uploadFiles_2_6Len = 0;
  uploadFiles_2_7Len = 0;
  uploadFiles_2_8Len = 0;
  uploadFiles_2_9Len = 0;

  //Detailed Presentation Files
  uploadFiles_3_0: string[] = [];
  uploadFiles_3_1: string[] = [];
  uploadFiles_3_2: string[] = [];
  uploadFiles_3_3: string[] = [];
  uploadFiles_3_4: string[] = [];

  uploadFiles_3_0Len = 0;
  uploadFiles_3_1Len = 0;
  uploadFiles_3_2Len = 0;
  uploadFiles_3_3Len = 0;
  uploadFiles_3_4Len = 0;

  //Application form and variables declared
  profilePhotoUpoadForm = new FormGroup({
    profilePhoto: new FormControl(""),
  });

  //Application form and variables declared
  applicationForm = new FormGroup({
    applicationValue: new FormControl("1", [Validators.required]),
  });

  //Feed back form and variables declared
  feedBackForm = new FormGroup({
    feedback: new FormControl("", [Validators.required]),
  });

  //First contact form and variables declared
  firstContactForm = new FormGroup({
    describeIdea1: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.descriptionPattern),
    ]),
    describeIdea2: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.descriptionPattern),
    ]),
    describeIdea3: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.descriptionPattern),
    ]),
    firstName: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.namePattern),
    ]),
    lastName: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.namePattern),
    ]),
    email: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.emailIdPattern),
    ]),
    organizationName: new FormControl("", [Validators.required]),
    orgDetails: new FormControl("", [Validators.required]),
    signUpEmail: new FormControl("", [Validators.requiredTrue]),
    sourceValue: new FormGroup(
      {
        newspaper: new FormControl(false),
        edm: new FormControl(false),
        sms: new FormControl(false),
        website: new FormControl(false),
        pressads: new FormControl(false),
        online: new FormControl(false),
        wordofmouth: new FormControl(false),
        maildrop: new FormControl(false),
        others: new FormControl(""),
      },
      this.requireCheckboxesToBeCheckedValidator()
    ),
    emailId: new FormControl(""),
    status: new FormControl(2),
  });

  //Brief assesment form and variables declared
  briefAssesmentForm = new FormGroup({
    name: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.namePattern),
    ]),
    address: new FormControl("", [Validators.required]),
    email: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.emailIdPattern),
    ]),
    telephoneNo: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.telePhonePattern),
    ]),
    website: new FormControl("", [Validators.required]),
    websiteUrl : new  FormControl("",[
      Validators.required,
      Validators.pattern(this.validation.webSiteUrl),
    ]),
    streetAddress : new  FormControl("", [Validators.required]),
    zipCode : new  FormControl("", [Validators.required,
      Validators.pattern(this.validation.numberPattern),]),
    city : new  FormControl("", [Validators.required]),
    country : new  FormControl("", [Validators.required]),
    ngoFoundedDate : new  FormControl("", [Validators.required]),
    countriesNgoActive : new  FormControl("", [Validators.required]),
    ngoVisionMission : new  FormControl("", [Validators.required]),
    ngoGoal : new  FormControl("", [Validators.required]),
    ngoLongTermStrategy : new  FormControl("", [Validators.required]),
    ngoOfferedActivities : new  FormControl("", [Validators.required]),
    ngoPlanning : new  FormControl("", [Validators.required]),
    ngoFinanced : new  FormControl("", [Validators.required]),
    purposeOfProject1: new FormControl(""),
    detailedInformation: new FormControl(""),
    estimatedBudget: new FormControl(""),
    periodOfTime: new FormControl(""),
    purposeOfProject2: new FormControl(""),
    ngoCertifiedOfficial: new FormControl(""),
    ngoCertifiedDeed: new FormControl(""),
    ngoCertifiedBudget: new FormControl(""),
    ngoCertifiedActivity: new FormControl(""),
    certifiedId: new FormControl(""), 
    emailId: new FormControl(""),
    status: new FormControl(2),
    uploadedFiles: new FormControl(),
  });
  //Detailed presentation form and variables declared
  detailedPresentaionForm = new FormGroup({
    purposeOfProject1: new FormControl("", [Validators.required]),
    detailedInformation: new FormControl("", [Validators.required]),
    estimatedBudget: new FormControl("", [Validators.required]),
    periodOfTime: new FormControl("", [Validators.required]),
    purposeOfProject2: new FormControl("", [Validators.required]),
    emailId: new FormControl(""),
    status: new FormControl(2),
    uploadedFiles: new FormControl(),
  });

  //Final approval form and variables declared
  finalApprovalForm = new FormGroup({
    submitButton: new FormControl(""),
    emailId: new FormControl(""),
    status: new FormControl(2),
  });

  //Constructor for this component
  constructor(
    private product: ProductService,
    private server: ServerCallService,
    private router: Router,
    private el: ElementRef,
    private validation: ValidationService,
    private modal: ModalService
  ) {
    this.loader = "Loading GISED user page";
    this.blockUI.start(this.loader);

    //Define intial values to the variables
    this.currentStatus = "Nil";
    this.loggedProfile = { title: "" };
    this.firstContactFormClose = "OPEN";
    this.briefAssesmentFormClose = "OPEN";
    this.detailedPresentationFormClose = "OPEN";
    this.finalApprovalFormClose == "OPEN";
    this.firstContactCompleted = 0;
    this.briefAssesmentCompleted = 0;
    this.detailedPresentationCompleted = 0;
    this.finalApprovalCompleted = 0;
    this.emailId = "";
    this.initialPresentForm = 1;

    //Prepare this request for get logged user informations
    this.serverRequest = {
      token: localStorage.getItem("token"),
      module: "userProfile",
      action: "showprofile",
      requestData: { emailId: this.emailId },
    };
    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        console.log("RESPONSE : ", this.serverResponse);

        // this.product.checkToken(this.serverResponse.responseData.token);
        if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
        } else {
          //Set token
          localStorage.setItem("token", this.serverResponse.responseData.token);

          //Load basic data informations from server
          this.loggedProfile = this.serverResponse.responseData.loggedProfile;
          this.applications = this.serverResponse.responseData.applications;
          this.currentStatus = this.serverResponse.responseData.status;
          this.presentFormNo = this.serverResponse.responseData.presentFormNo;
          this.action = this.serverResponse.responseData.action;
          this.emailId = this.loggedProfile.email_id;
          this.profileImg = this.loggedProfile.profileImg;
          // -=*** REMOVE ***=-
          this.initialPresentForm = this.serverResponse.responseData.presentFormNo;
          this.faq = this.serverResponse.responseData.faq;

          //Set for wordpress user name show
          localStorage.setItem("gised_user", this.loggedProfile.first_name);

          //Load form inforamtion from the server
          this.firstContactValues = this.serverResponse.responseData.firstContactForm;
          this.briefAssesmentValues = this.serverResponse.responseData.briefAssesmentForm;
          this.detailedPresentationValues = this.serverResponse.responseData.detailedPresentationForm;
          this.finalApproval = this.serverResponse.responseData.finalApprovalForm;

          //Form open and close according to the user access
          this.firstContactFormClose = this.serverResponse.responseData.close.firstContactFormClose;

          if (this.firstContactFormClose == "CLOSE") {
            this.firstContactFormSelector.classList.add("completed");
            this.firstContactCompleted = 1;
          }
          this.briefAssesmentFormClose = this.serverResponse.responseData.close.briefAssesmentFormClose;
          if (this.briefAssesmentFormClose == "CLOSE") {
            this.briefAssesmentFormSelector.classList.add("completed");
            this.briefAssesmentCompleted = 2;
          }
          this.detailedPresentationFormClose = this.serverResponse.responseData.close.detailedPresentationFormClose;
          if (this.detailedPresentationFormClose == "CLOSE") {
            this.detailedPresentationFormSelector.classList.add("completed");
            this.detailedPresentationCompleted = 3;
          }
          this.finalApprovalFormClose = this.serverResponse.responseData.close.finalApprovalFormClose;
          if (this.finalApprovalFormClose == "CLOSE") {
            this.finalApprovalCompleted = 4;
          }

          //Open form for initial action
          if (this.action == "firstcontactforminsertion") {
            this.firstContactForm.enable();
          } else if (this.action == "briefassesmentforminsertion") {
            this.briefAssesmentForm.enable();
          } else if (this.action == "detailedpresentationforminsertion") {
            this.detailedPresentaionForm.enable();
          }

          //Load the exsisting values
          if (this.action == "firstcontactformupdation") {
            this.firstContactFormValuesUpdate();
          }
          if (this.action == "briefassesmentformupdation") {
            this.briefAssementFormValuesUpdate();
          }
        }
      },
      (error) => {
        this.errorMsg = "Sorry! Something went wrong";
      },
      () => {
        console.log("Completed");
      }
    );

    //Get Contries
    this.serverRequest = {
      token: localStorage.getItem("token"),
      module: "login",
      action: "getcountries",
      requestData: "",
    };

    this.loader = "Preparing User page";
    this.blockUI.start(this.loader);

    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        // this.product.checkToken(this.serverResponse.responseData.token);
        this.blockUI.stop();
        this.loader = "";
        if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
        } else {
          this.countries = this.serverResponse.responseData.countries;
        }
        this.setProfileValues();
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
      },
      () => {
        console.log("Completed");
      }
    );
  }

  //Edit Profile
  editProfileForm = new FormGroup({
    nameOfFoundation: new FormControl("", [Validators.required]),
    dateOfFoundation: new FormControl("", [Validators.required]),
    countryReg: new FormControl("", [Validators.required]),
    fullName: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.namePattern),
    ]),
    dob: new FormControl("", [Validators.required]),
    mobileNo: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.mobilePattern),
    ]),
    gender: new FormControl("", [Validators.required]),
    country: new FormControl(0, [Validators.required, Validators.min(1)]),
    applicationValues: new FormControl(0, [
      Validators.required,
      Validators.min(1),
    ]),
    image: new FormControl("", [Validators.required]),
    emailId: new FormControl(""),
  });

  setProfileValues() {
    if (this.loggedProfile.organization_name != "") {
      //alert("name :"+this.loggedProfile.first_name);
      this.editProfileForm.controls.nameOfFoundation.setValue(
        this.loggedProfile.organization_name
      );
    }
    if (this.loggedProfile.age != "0000-00-00") {
      this.editProfileForm.controls.dob.setValue(
        this.loggedProfile.age
      );
    }
    if (this.loggedProfile.countryReg != 1) {
      this.editProfileForm.controls.country.setValue(
        this.loggedProfile.r_country_id
      );
    } else {
      this.editProfileForm.controls.country.setValue(0);
    }
    if (this.loggedProfile.first_name != "") {
      //alert("name :"+this.loggedProfile.first_name);
      this.editProfileForm.controls.fullName.setValue(
        this.loggedProfile.first_name
      );
    }
    if (this.loggedProfile.date_of_foundation != "0000-00-00") {
      this.editProfileForm.controls.dob.setValue(
        this.loggedProfile.date_of_foundation
      );
    }
    
    if (this.loggedProfile.mobile_no != "Nil") {
      this.editProfileForm.controls.mobileNo.setValue(
        this.loggedProfile.mobile_no
      );
    }
    if (this.loggedProfile.gender != "Nil") {
      this.editProfileForm.controls.gender.setValue(this.loggedProfile.gender);
    }
    if (this.loggedProfile.r_country_id != 1) {
      this.editProfileForm.controls.country.setValue(
        this.loggedProfile.r_country_id
      );
    } else {
      this.editProfileForm.controls.country.setValue(0);
    }
    if (this.loggedProfile.field_of_activity != "Nil") {
      this.editProfileForm.controls.applicationValues.setValue(
        this.loggedProfile.field_of_activity
      );
    } else {
      this.editProfileForm.controls.applicationValues.setValue(0);
    }
    this.editProfileForm.controls.image.setValue("noImage");
    this.editProfileForm.controls.emailId.setValue(this.loggedProfile.email_id);
  }

  //After dom ready will get call
  ngOnInit() {
    //Body class chaged to applications
    this.product.login();

    //this.selectedApplication = 1;
    //this.applicationForm.controls.applicationValue.setValue(1);
    this.applicationForm.get("applicationValue").setValue(1);

    //Select the element to load class
    this.firstContactFormSelector = this.el.nativeElement.querySelector(
      "#firstContactFormId"
    );
    this.briefAssesmentFormSelector = this.el.nativeElement.querySelector(
      "#briefAssesmentFormId"
    );
    this.detailedPresentationFormSelector = this.el.nativeElement.querySelector(
      "#detailedPresentationFormId"
    );
    this.feedBackUserSelector = this.el.nativeElement.querySelector(
      "#feedbackuser"
    );

    //Form disable
    this.formsDisable();

    this.blockUI.stop();
    this.loader = "";
  }

  ////Form disable
  formsDisable() {
    this.firstContactForm.disable();
    this.briefAssesmentForm.disable();
    this.detailedPresentaionForm.disable();
    this.finalApprovalForm.disable();
  }

  //Logout the logged user
  logout() {
    this.product.logout();
  }

  sendFeedbackPopup() {
    this.feedBackUserSelector.classList.add("show-modal");
  }

  firstContactFormValuesUpdate() {
    if (this.firstContactValues.brief_idea != "") {
      this.firstContactForm.controls.describeIdea1.setValue(
        this.firstContactValues.brief_idea
      );
    }
    if (this.firstContactValues.explained_idea != "") {
      this.firstContactForm.controls.describeIdea2.setValue(
        this.firstContactValues.explained_idea
      );
    }
    if (this.firstContactValues.about_group != "") {
      this.firstContactForm.controls.describeIdea3.setValue(
        this.firstContactValues.about_group
      );
    }
    if (this.firstContactValues.first_name != "") {
      this.firstContactForm.controls.firstName.setValue(
        this.firstContactValues.first_name
      );
    }
    if (this.firstContactValues.last_name != "") {
      this.firstContactForm.controls.lastName.setValue(
        this.firstContactValues.last_name
      );
    }
    if (this.firstContactValues.email != "") {
      this.firstContactForm.controls.email.setValue(
        this.firstContactValues.email_id
      );
    }
    if (this.firstContactValues.organization_name != "") {
      this.firstContactForm.controls.organizationName.setValue(
        this.firstContactValues.organization_name
      );
    }
    if (this.firstContactValues.org_details != "") {
      this.firstContactForm.controls.orgDetails.setValue(
        this.firstContactValues.org_details
      );
    }
    if (this.firstContactValues.sign_up_for_emails != "") {
      this.firstContactForm.controls.signUpEmail.setValue(
        this.firstContactValues.sign_up_for_emails == "Y" ? true : false
      );
    }
    if (this.firstContactValues.r_source_id.newspaper == true) {
      this.firstContactForm.controls.sourceValue
        .get("newspaper")
        .setValue(true);
    }
    if (this.firstContactValues.r_source_id.edm == true) {
      this.firstContactForm.controls.sourceValue.get("edm").setValue(true);
    }
    if (this.firstContactValues.r_source_id.sms == true) {
      this.firstContactForm.controls.sourceValue.get("sms").setValue(true);
    }
    if (this.firstContactValues.r_source_id.website == true) {
      this.firstContactForm.controls.sourceValue.get("website").setValue(true);
    }
    if (this.firstContactValues.r_source_id.pressads == true) {
      this.firstContactForm.controls.sourceValue.get("pressads").setValue(true);
    }
    if (this.firstContactValues.r_source_id.online == true) {
      this.firstContactForm.controls.sourceValue.get("online").setValue(true);
    }
    if (this.firstContactValues.r_source_id.wordofmouth == true) {
      this.firstContactForm.controls.sourceValue
        .get("wordofmouth")
        .setValue(true);
    }
    if (this.firstContactValues.r_source_id.maildrop == true) {
      this.firstContactForm.controls.sourceValue.get("maildrop").setValue(true);
    }
    if (this.firstContactValues.r_source_id.others != "") {
      this.firstContactForm.controls.sourceValue
        .get("others")
        .setValue(this.firstContactValues.r_source_id.others);
    }
  }

  briefAssementFormValuesUpdate() {
    if (this.briefAssesmentValues.full_name != "") {
      this.briefAssesmentForm.controls.name.setValue(
        this.briefAssesmentValues.full_name
      );
    }
    if (this.briefAssesmentValues.address != "") {
      this.briefAssesmentForm.controls.address.setValue(
        this.briefAssesmentValues.address
      );
    }
    if (this.briefAssesmentValues.email_id != "") {
      this.briefAssesmentForm.controls.email.setValue(
        this.briefAssesmentValues.email_id
      );
    }
    if (this.briefAssesmentValues.telephone_number != "") {
      this.briefAssesmentForm.controls.telephoneNo.setValue(
        this.briefAssesmentValues.telephone_number
      );
    }
    if (this.briefAssesmentValues.website_url != "") {
      this.briefAssesmentForm.controls.website.setValue(
        this.briefAssesmentValues.website_url == "Y" ? true : false
      );
    }
    if (this.briefAssesmentValues.street_address != "") {
      this.briefAssesmentForm.controls.streetAddress.setValue(
        this.briefAssesmentValues.street_address
      );
    }
    if (this.briefAssesmentValues.zip_code != "") {
      this.briefAssesmentForm.controls.zipCode.setValue(
        this.briefAssesmentValues.zip_code
      );
    }
    if (this.briefAssesmentValues.city != "") {
      this.briefAssesmentForm.controls.city.setValue(
        this.briefAssesmentValues.city
      );
    }
    if (this.briefAssesmentValues.country != "") {
      this.briefAssesmentForm.controls.country.setValue(
        this.briefAssesmentValues.country
      );
    }
    if (this.briefAssesmentValues.ngo_founded_date != "") {
      this.briefAssesmentForm.controls.ngoFoundedDate.setValue(
        this.briefAssesmentValues.ngo_founded_date
      );
    }
    if (this.briefAssesmentValues.countries_ngo_active != "") {
      this.briefAssesmentForm.controls.countriesNgoActive.setValue(
        this.briefAssesmentValues.countries_ngo_active
      );
    }
    if (this.briefAssesmentValues.ngo_vision_mission != "") {
      this.briefAssesmentForm.controls.ngoVisionMission.setValue(
        this.briefAssesmentValues.ngo_vision_mission
      );
    }
    if (this.briefAssesmentValues.ngo_goal != "") {
      this.briefAssesmentForm.controls.ngoGoal.setValue(
        this.briefAssesmentValues.ngo_goal
      );
    }
    if (this.briefAssesmentValues.ngo_long_term_strategy != "") {
      this.briefAssesmentForm.controls.ngoLongTermStrategy.setValue(
        this.briefAssesmentValues.ngo_long_term_strategy
      );
    }
    if (this.briefAssesmentValues.ngo_offered_activities != "") {
      this.briefAssesmentForm.controls.ngoOfferedActivities.setValue(
        this.briefAssesmentValues.ngo_offered_activities
      );
    }
    if (this.briefAssesmentValues.ngo_planning != "") {
      this.briefAssesmentForm.controls.ngoPlanning.setValue(
        this.briefAssesmentValues.ngo_planning
      );
    }
    if (this.briefAssesmentValues.ngo_financed != "") {
      this.briefAssesmentForm.controls.ngoFinanced.setValue(
        this.briefAssesmentValues.ngo_financed
      );
    }

  }

  feedBackFormSubmit() {
    this.serverRequest = {
      token: localStorage.getItem("token"),
      module: "mailer",
      action: "feedback",
      requestData: this.feedBackForm.value,
    };

    this.loader = "Sending suggestion to GISED admin";
    this.blockUI.start(this.loader);

    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        this.product.checkToken(this.serverResponse.responseData.token);

        this.blockUI.stop();
        this.loader = "";
        if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
        } else {
          this.feedBackForm.reset();
          this.errorMsg = this.serverResponse.responseData.userMsg;
          Swal.fire(this.errorMsg);
        }
        this.closeModal("feedback-modal");
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
        this.closeModal("feedback-modal");
      },
      () => {
        console.log("Completed");
      }
    );
  }

  seeDetails(formNo) {
    if (formNo == 1) {
      if (this.firstContactFormClose == "OPEN") {
        this.firstContactFormClose = "CLOSE";
        this.firstContactFormSelector.classList.add("completed");
      } else if (this.firstContactFormClose == "CLOSE") {
        this.firstContactFormClose = "OPEN";
        this.firstContactFormSelector.classList.remove("completed");
      }
    } else if (formNo == 2) {
      if (this.briefAssesmentFormClose == "OPEN") {
        this.briefAssesmentFormClose = "CLOSE";
        this.briefAssesmentFormSelector.classList.add("completed");
      } else if (this.briefAssesmentFormClose == "CLOSE") {
        this.briefAssesmentFormClose = "OPEN";
        this.briefAssesmentFormSelector.classList.remove("completed");
      }
    } else if (formNo == 3) {
      if (this.detailedPresentationFormClose == "OPEN") {
        this.detailedPresentationFormClose = "CLOSE";
        this.detailedPresentationFormSelector.classList.add("completed");
      } else if (this.detailedPresentationFormClose == "CLOSE") {
        this.detailedPresentationFormClose = "OPEN";
        this.detailedPresentationFormSelector.classList.remove("completed");
      }
    }
  }

  //Form submission
  formSubmit(data) {
    //Get logged user details
    data.emailId = this.emailId;

    //Prepare this request for insert first contact form informations
    this.serverRequest = {
      token: localStorage.getItem("token"),
      module: "application",
      action: this.action,
      requestData: data,
    };

    this.loader = "Inserting the form data";
    this.blockUI.start(this.loader);

    //Hit to the server for insert first contact form informations
    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        this.product.checkToken(this.serverResponse.responseData.token);
        this.blockUI.stop();
        this.loader = "";
        if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
        } else {
          this.presentFormNo = this.serverResponse.responseData.presentFormNo;
          this.action = this.serverResponse.responseData.action;
          this.userMsg = this.serverResponse.responseData.userMsg;
          this.currentStatus = this.serverResponse.responseData.status;
          this.formsDisable();
          if (this.action == "briefassesmentforminsertion") {
            this.briefAssesmentForm.enable();
          } else if (this.action == "detailedpresentationforminsertion") {
            this.detailedPresentaionForm.enable();
          }
          Swal.fire(this.userMsg);
        }
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
      },
      () => {
        console.log("Completed");
      }
    );
  }

  firstContactFormInsert() {
    if (this.presentFormNo == 0) {
      Swal.fire("Till get approve, You cant proceed with another form");
      return false;
    }

    this.firstContactForm.controls.status.setValue(2);
    this.formSubmit(this.firstContactForm.value);
  }

  //Final approval presentation form insertion
  finalApprovalFormInsert() {
    if (this.presentFormNo == 0) {
      Swal.fire("Till get approve, You cant proceed with another form");
      return false;
    }

    this.finalApprovalForm.controls.status.setValue(2);
    this.formSubmit(this.finalApprovalForm.value);
  }

  //Save present form values
  saveAsDraft() {
    //Check the conditions for which form present
    if (this.presentFormNo == 1) {
      this.firstContactForm.controls.status.setValue(3);
      this.formSubmit(this.firstContactForm.value);
    } else if (this.presentFormNo == 2) {
      this.briefAssesmentForm.controls.status.setValue(3);
      this.briefFileAppend();
    } else if (this.presentFormNo == 3) {
      this.detailedPresentaionForm.controls.status.setValue(3);
      this.detailedFileAppend();
    } else {
      Swal.fire("Till get approve, You cant proceed with another form");
    }
  }

  //Edit present form
  editForm() {
    //Check the conditions for which form present
    if (this.presentFormNo == 1) {
      this.firstContactForm.enable();
    } else if (this.presentFormNo == 2) {
      this.briefAssesmentForm.enable();
    } else if (this.presentFormNo == 3) {
      this.detailedPresentaionForm.enable();
    } else {
      Swal.fire("Till get approve, You cant proceed with another form");
    }
  }

  //Share the form according to the action
  shareDetails(formNo, formName) {
    this.loader = "Creating form data to PDF";
    this.blockUI.start(this.loader);

    let data;
    if (formNo == 1) {
      data = document.getElementById("firstContactFormId");
    } else if (formNo == 2) {
      data = document.getElementById("briefAssesmentFormId");
    } else if (formNo == 3) {
      data = document.getElementById("detailedPresentationFormId");
    }

    html2canvas(data).then((canvas) => {
      // Few necessary setting options
      var imgWidth = 208;
      var pageHeight = 295;
      var imgHeight = (canvas.height * imgWidth) / canvas.width;
      var heightLeft = imgHeight;

      const contentDataURL = canvas.toDataURL("image/png");
      let pdf = new jspdf("p", "mm", "a4"); // A4 size page of PDF
      var position = 0;
      pdf.addImage(contentDataURL, "PNG", 0, position, imgWidth, imgHeight);
      pdf.save(formName); // Generated PDF
    });

    Swal.fire(formName + " downloaded successfully");

    this.blockUI.stop();
    this.loader = "";
  }

  getSelectedFileList(event) {
    if (event.target.files && event.target.files[0]) {
      let filesCount = event.target.files.length;
      console.log(event.target);
      console.log(event.target.files);
      for (let i = 0; i < filesCount; i++) {
        console.log(event.target.result);
      }
    }
  }

  /****************************Brief Assesment Form works *******************************/

  onFileChangePurpose(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_0.push(event.target.files[i]);
        this.uploadFiles_2_0Len = this.uploadFiles_2_0Len + 1;
      }
    }
  }

  onFileChangeDetailed(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_1.push(event.target.files[i]);
        this.uploadFiles_2_1Len = this.uploadFiles_2_1Len + 1;
      }
    }
  }

  onFileChangeEstimated(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_2.push(event.target.files[i]);
        this.uploadFiles_2_2Len = this.uploadFiles_2_2Len + 1;
      }
    }
  }

  onFileChangePeriod(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_3.push(event.target.files[i]);
        this.uploadFiles_2_3Len = this.uploadFiles_2_3Len + 1;
      }
    }
  }

  onFileChangePurpose1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_4.push(event.target.files[i]);
        this.uploadFiles_2_4Len = this.uploadFiles_2_4Len + 1;
      }
    }
  }

  onFileChangeNgoCertifiedOfficial(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_5.push(event.target.files[i]);
        this.uploadFiles_2_5Len = this.uploadFiles_2_5Len + 1;
      }
    }
  }

  onFileChangeNgoCertifiedDeed(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_6.push(event.target.files[i]);
        this.uploadFiles_2_6Len = this.uploadFiles_2_6Len + 1;
      }
    }
  }

  onFileChangeNgoCertifiedBudget(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_7.push(event.target.files[i]);
        this.uploadFiles_2_7Len = this.uploadFiles_2_7Len + 1;
      }
    }
  }

  onFileChangeNgoCertifiedActivity(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_8.push(event.target.files[i]);
        this.uploadFiles_2_8Len = this.uploadFiles_2_8Len + 1;
      }
    }
  }

  onFileChangeCertifiedId(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_2_9.push(event.target.files[i]);
        this.uploadFiles_2_9Len = this.uploadFiles_2_9Len + 1;
      }
    }
  }

  //Brief assesment form insertion
  briefAssesmentFormInsert() {
    if (this.presentFormNo == 0) {
      Swal.fire("Till get approve, You cant proceed with another form");
      return false;
    }

    this.briefAssesmentForm.controls.status.setValue(2);
    this.briefFileAppend();
  }

  briefFileAppend() {
    this.loader = "Uploading files";
    this.blockUI.start(this.loader);

    const formData = new FormData();

    for (var i = 0; i < this.uploadFiles_2_0.length; i++) {
      formData.append("purpose[]", this.uploadFiles_2_0[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_1.length; i++) {
      formData.append("detailed[]", this.uploadFiles_2_1[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_2.length; i++) {
      formData.append("estimated[]", this.uploadFiles_2_2[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_3.length; i++) {
      formData.append("period[]", this.uploadFiles_2_3[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_4.length; i++) {
      formData.append("purpose1[]", this.uploadFiles_2_4[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_5.length; i++) {
      formData.append("ngoCertifiedOfficial[]", this.uploadFiles_2_5[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_6.length; i++) {
      formData.append("ngoCertifiedDeed[]", this.uploadFiles_2_6[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_7.length; i++) {
      formData.append("ngoCertifiedBudget[]", this.uploadFiles_2_7[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_8.length; i++) {
      formData.append("ngoCertifiedActivity[]", this.uploadFiles_2_8[i]);
    }

    for (var i = 0; i < this.uploadFiles_2_9.length; i++) {
      formData.append("certifiedId[]", this.uploadFiles_2_9[i]);
    }

    formData.append("formValue", "2");

    this.fileUpload(formData, 2);
  }

  /***************************************Detailed Presentation******************************************/
  onFileChangePurpose_1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_3_0.push(event.target.files[i]);
        this.uploadFiles_3_0Len = this.uploadFiles_3_0Len + 1;
      }
    }
  }

  onFileChangeDetailed_1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_3_1.push(event.target.files[i]);
        this.uploadFiles_3_1Len = this.uploadFiles_3_1Len + 1;
      }
    }
  }

  onFileChangeEstimated_1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_3_2.push(event.target.files[i]);
        this.uploadFiles_3_2Len = this.uploadFiles_3_2Len + 1;
      }
    }
  }

  onFileChangePeriod_1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_3_3.push(event.target.files[i]);
        this.uploadFiles_3_3Len = this.uploadFiles_3_3Len + 1;
      }
    }
  }

  onFileChangePurpose1_1(event) {
    for (var i = 0; i < event.target.files.length; i++) {
      if (event.target.files[i].size > this.maxAllowedSize) {
        alert("File is too big! Max Allowed 15MB");
      } else {
        this.uploadFiles_3_4.push(event.target.files[i]);
        this.uploadFiles_3_4Len = this.uploadFiles_3_4Len + 1;
      }
    }
  }

  //Detailed presentation form insertion
  detailedPresentaionFormInsert() {
    if (this.presentFormNo == 0) {
      Swal.fire("Till get approve, You cant proceed with another form");
      return false;
    }

    this.detailedPresentaionForm.controls.status.setValue(2);
    this.detailedFileAppend();
  }

  detailedFileAppend() {
    this.loader = "Uploading files";
    this.blockUI.start(this.loader);

    const formData = new FormData();

    for (var i = 0; i < this.uploadFiles_3_0.length; i++) {
      formData.append("purpose[]", this.uploadFiles_3_0[i]);
    }

    for (var i = 0; i < this.uploadFiles_3_1.length; i++) {
      formData.append("detailed[]", this.uploadFiles_3_1[i]);
    }

    for (var i = 0; i < this.uploadFiles_3_2.length; i++) {
      formData.append("estimated[]", this.uploadFiles_3_2[i]);
    }

    for (var i = 0; i < this.uploadFiles_3_3.length; i++) {
      formData.append("period[]", this.uploadFiles_3_3[i]);
    }

    for (var i = 0; i < this.uploadFiles_3_4.length; i++) {
      formData.append("purpose1[]", this.uploadFiles_3_4[i]);
    }

    formData.append("formValue", "3");

    this.fileUpload(formData, 3);
  }

  fileUpload(formData, formNo) {
    this.server.sendToServer1(formData).subscribe(
      (response) => {
        this.blockUI.stop();
        this.loader = "";
        //this.serverResponse = JSON.parse(this.server.decryption(response['response']));
        //this.serverResponse = JSON.parse(response);
        console.log("RESPONSE : ", JSON.stringify(response));
        //alert('success');
        //return JSON.stringify(response);
        if (formNo == 2) {
          this.briefAssesmentForm.controls.uploadedFiles.setValue(response);
          this.formSubmit(this.briefAssesmentForm.value);
        } else if (formNo == 3) {
          this.detailedPresentaionForm.controls.uploadedFiles.setValue(
            response
          );
          this.formSubmit(this.detailedPresentaionForm.value);
        }
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        //console.log('Error : ', JSON.stringify(error));
        Swal.fire(this.errorMsg);
        this.router.navigate(["/"]);
      },
      () => {
        console.log("Completed");
      }
    );
  }

  //Edit Profile Image
  onSelectProfileImage(event) {
    if (event.target.files && event.target.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]); // read file as data url
      reader.onload = (event) => {
        // called once readAsDataURL is completed
        let profileImg = reader.result;
        //console.log("base 64 :"+reader.result);

        this.serverRequest = {
          token: localStorage.getItem("token"),
          module: "userProfile",
          action: "profilephotoupload",
          requestData: { image: profileImg, emailId: this.emailId },
        };

        this.loader = "Profile photo uploading";
        this.blockUI.start(this.loader);

        this.server.sendToServer(this.serverRequest).subscribe(
          (response) => {
            this.serverResponse = JSON.parse(
              this.server.decryption(response["response"])
            );
            console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
            this.blockUI.stop();
            this.loader = "";
            if (this.serverResponse.responseData.status == "EMPTY") {
              this.errorMsg = "Sorry! Something went wrong";
              Swal.fire(this.errorMsg);
            } else if (this.serverResponse.responseData.status == "ERROR") {
              this.errorMsg = "Sorry! Something went wrong";
              Swal.fire(this.errorMsg);
            } else {
              this.profileImg = this.serverResponse.responseData.profileImg;
              this.errorMsg = "Profile picture updated";
              Swal.fire(this.errorMsg);
            }
          },
          (error) => {
            this.blockUI.stop();
            this.loader = "";
            this.errorMsg = "Sorry! Something went wrong";
            Swal.fire(this.errorMsg);
          },
          () => {
            console.log("Completed");
          }
        );
      };
    }
  }

  openModal(id: string) {
    this.modal.open(id);
  }

  closeModal(id: string) {
    this.modal.close(id);
  }

  //Edit Profile Image
  onSelectProfileImages(event) {
    if (event.target.files && event.target.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]); // read file as data url
      reader.onload = (event) => {
        // called once readAsDataURL is completed
        this.profileImg = reader.result;
        //console.log("base 64 :"+reader.result);
        this.editProfileForm.controls.image.setValue(this.profileImg);
        //this.profileImgString = this.profileImg;
      };
    }
  }

  editProfileSubmit() {
    this.serverRequest = {
      token: localStorage.getItem("token"),
      module: "userProfile",
      action: "editProfile",
      requestData: this.editProfileForm.value,
    };

    this.loader = "Updating your profile on GISED";
    this.blockUI.start(this.loader);

    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", this.serverResponse);
        this.blockUI.stop();
        this.loader = "";
        if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
        } else {
          this.errorMsg = "Account Updated Successfully.";
          Swal.fire(this.errorMsg);
          this.loggedProfile = this.serverResponse.responseData.loggedProfile;
          this.profileImg = this.loggedProfile.profileImg;
        }
        this.closeModal("userProfile-modal");
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
        this.closeModal("userProfile-modal");
      },
      () => {
        console.log("Completed");
      }
    );
  }

  // Accordian FAQ
  toggleFaq(e) {
    e.preventDefault();
    e.stopPropagation();
    e.target.nextElementSibling.classList.toggle("open");
  }

  //Select Any one Checkbox Validation
  requireCheckboxesToBeCheckedValidator(minRequired = 1): ValidatorFn {
    return function validate(formGroup: FormGroup) {
      let checked = 0;

      Object.keys(formGroup.controls).forEach((key) => {
        const control = formGroup.controls[key];

        if (control.value === true) {
          checked++;
        }
      });

      //alert(formGroup.controls.others.value);

      if (formGroup.controls.others.value != "") {
        checked++;
      }

      if (checked < minRequired) {
        return {
          requireCheckboxesToBeChecked: true,
        };
      }

      return null;
    };
  }
}
