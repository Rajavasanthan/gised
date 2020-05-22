//Need library files imported
import { Component, OnInit, ElementRef } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { ServerCallService } from '../../../services/server-call.service';
import { FormGroup, FormControl, Validators, FormArray } from '@angular/forms';
import { Router } from '@angular/router';
import { Configurations } from '../../../config/configurations';
import { saveAs as importedSaveAs } from 'file-saver';
import { BlockUI, NgBlockUI } from 'ng-block-ui';
import Swal from "sweetalert2";
import { ValidationService } from "src/app/services/validation.service";
import { ModalService } from "../../../modal";

//Specifid the this component schema
@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})

//Class implmentation for this component
export class AdminComponent implements OnInit {

  @BlockUI() blockUI: NgBlockUI;

  //Variable decrlation with its type
  loggedProfile : any;
  applications : any;
  source : any;
  serverRequest : any;
  serverResponse : any;
  errorMsg : string;
  action : string;
  userMsg : string;
  presentFormNo : number;
  firstContactValues : any;
  briefAssesmentValues : any;
  detailedPresentationValues : any;
  finalApproval : any;
  selectedApplication : number;
  currentStatus : string;
  firstContactFormClose : string;
  briefAssesmentFormClose : string;
  detailedPresentationFormClose : string;
  firstContactFormSelector : any;
  briefAssesmentFormSelector : any;
  detailedPresentationFormSelector : any;
  adminTableView : string;
  adminFormView : string;
  userRequestList : any;
  userRequestListCount : number;
  statusTrackingDetailsId : number;
  processUserId : number;
  processEmailId : string;
  progressBar : string;
  progressMessage : String;
  emailId : string;
  approvalBy : number;
  gisedId : number;
  loader : string; 
  profileImg : any;
  countries: any;

   //Files Size Allowed
   maxAllowedSize = Configurations.MAX_FILE_UPLOAD_SIZE;

   //Files Accepet Types
   fileTypes = Configurations.FILE_UPLOAD_ACCEPET_TYPES;

   //Profile Image Files Accepet Types
   profileImgFileTypes = Configurations.PROFILE_IMG_UPLOAD_ACCEPET_TYPES;

   //Breaf assesment files
   uploadFiles_2_0:string  [] = [];
   uploadFiles_2_1:string [] = [];
   uploadFiles_2_2:string [] = [];
   uploadFiles_2_3:string [] = [];
   uploadFiles_2_4:string [] = [];
 
   uploadFiles_2_0Len =0;
   uploadFiles_2_1Len =0;
   uploadFiles_2_2Len =0;
   uploadFiles_2_3Len =0;
   uploadFiles_2_4Len =0;
 
   //Detailed Presentation Files
   uploadFiles_3_0:string  [] = [];
   uploadFiles_3_1:string [] = [];
   uploadFiles_3_2:string [] = [];
   uploadFiles_3_3:string [] = [];
   uploadFiles_3_4:string [] = [];
 
   uploadFiles_3_0Len =0;
   uploadFiles_3_1Len =0;
   uploadFiles_3_2Len =0;
   uploadFiles_3_3Len =0;
   uploadFiles_3_4Len =0;


  //Application form and variables declared
  profilePhotoUpoadForm = new FormGroup({
    profilePhoto : new FormControl("")
  });
 

  //Application form and variables declared
  applicationForm = new FormGroup({
    applicationValue : new FormControl('1',[Validators.required])
  });

  //Feed back form and variables declared
  feedBackForm = new FormGroup({
    feedback : new FormControl('',[Validators.required]),
    userEmailId : new FormControl(''),
    loggedEmailId : new FormControl('')
    
  });

  //First contact form and variables declared
  firstContactForm = new FormGroup({
    describeIdea1 : new FormControl('', [Validators.required]),
    describeIdea2 : new FormControl('', [Validators.required]),
    describeIdea3 : new FormControl('', [Validators.required]),
    firstName : new FormControl('', [Validators.required]),
    lastName : new FormControl('', [Validators.required]),
    email : new FormControl('', [Validators.required, Validators.email]),
    organizationName : new FormControl('', [Validators.required]),
    orgDetails : new FormControl('', [Validators.required]),
    signUpEmail : new FormControl('', [Validators.required]),
    sourceValue : new FormGroup({
      newspaper : new FormControl(false),
      edm : new FormControl(false),
      sms : new FormControl(false),
      website : new FormControl(false),
      pressads : new FormControl(false),
      online : new FormControl(false),
      wordofmouth : new FormControl(false),
      maildrop : new FormControl(false),
      others : new FormControl('')
    }),
    emailId : new FormControl(''),
    status : new FormControl(2)
  });

  //Brief assesment form and variables declared
  briefAssesmentForm = new FormGroup({
    name : new FormControl('',[Validators.required]),
    address : new FormControl('',[Validators.required]),
    email : new FormControl('',[Validators.required]),
    telephoneNo : new FormControl(0,[Validators.required]),
    website : new FormControl('',[Validators.required]),    
    purposeOfProject1 : new FormControl('',[Validators.required]),
    detailedInformation : new FormControl('',[Validators.required]),
    estimatedBudget : new FormControl('',[Validators.required]),
    periodOfTime : new FormControl('',[Validators.required]),
    purposeOfProject2 : new FormControl('',[Validators.required]),
    emailId : new FormControl(''),
    status : new FormControl(2),
    uploadedFiles : new FormControl()
  });

  //Detailed presentation form and variables declared
  detailedPresentaionForm = new FormGroup({
    purposeOfProject1 : new FormControl('',[Validators.required]),
    detailedInformation : new FormControl('',[Validators.required]),
    estimatedBudget : new FormControl('',[Validators.required]),
    periodOfTime : new FormControl('',[Validators.required]),
    purposeOfProject2 : new FormControl('',[Validators.required]),
    emailId : new FormControl(''),
    status : new FormControl(2),
    uploadedFiles : new FormControl()
  });

  //Final approval form and variables declared
  finalApprovalForm = new FormGroup({
    submitButton : new FormControl(''),
    emailId : new FormControl(''),
    status : new FormControl(2)
  });

  holdApprovalForm = new FormGroup({
    reason : new FormControl('',[Validators.required]),
  });

  rejectApprovalForm = new FormGroup({
    reason : new FormControl('',[Validators.required]),
  });

  //Constructor for this component
  constructor(private product:ProductService, private server:ServerCallService, private router: Router, private el: ElementRef,private validation: ValidationService,
    private modal: ModalService) { 
  
    this.loader = "Loading GISED admin page";
    this.blockUI.start(this.loader);
    
      //Define intial values to the variables
      this.currentStatus = 'Nil';
      this.loggedProfile = { title : '' };
      this.firstContactFormClose = "OPEN";
      this.briefAssesmentFormClose = "OPEN";
      this.detailedPresentationFormClose = "OPEN";
      this.adminTableView = "OPEN";
      this.adminFormView = "CLOSE";
      this.userRequestListCount = 0;
      this.statusTrackingDetailsId = 0;
      this.processUserId = 0;
      this.processEmailId = '';
      this.emailId = '';
      this.approvalBy = 0;
      this.gisedId = 0;
      this.emailId = '';

      //Prepare this request for get logged user informations
      this.serverRequest = {
        'token' : localStorage.getItem('token'),
        'module' : 'userProfile',
        'action' : 'showprofile',
        'requestData' : { 'emailId' : this.emailId }
      } 
      //Hit to the server for get logged user informations
      this.server.sendToServer(this.serverRequest).
      subscribe((response) => {
        this.serverResponse = JSON.parse(this.server.decryption(response['response']));
        console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
        console.log('RESPONSE : ', this.serverResponse);
        if(this.serverResponse.responseData == 'ERROR') {
          this.errorMsg = 'Sorry! Something went wrong';
        } else {

          //Set token
          localStorage.setItem('token', this.serverResponse.responseData.token);

          //Load basic data informations from server
          this.loggedProfile =  this.serverResponse.responseData.loggedProfile;
          this.emailId = this.serverResponse.responseData.loggedProfile.email_id;
          this.profileImg = this.loggedProfile.profileImg;

          //Admin process assigned
          this.userRequestList = this.serverResponse.responseData.userRequestList;
          this.userRequestListCount = this.serverResponse.responseData.userRequestListCount;

        }
      }, (error) => {
        this.errorMsg = 'Sorry! Something went wrong';
      }, () => {
        console.log('Completed');
      });


      //Get Contries
    this.serverRequest = {
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

  setProfileValues() {
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
    }else{
      this.editProfileForm.controls.country.setValue(0);
    }
    if (this.loggedProfile.field_of_activity != "Nil") {
      this.editProfileForm.controls.applicationValues.setValue(
        this.loggedProfile.field_of_activity
      );
    }else{
      this.editProfileForm.controls.applicationValues.setValue(0);
    }
    this.editProfileForm.controls.image.setValue("noImage");
    this.editProfileForm.controls.emailId.setValue(this.loggedProfile.email_id);
  }


  //After dom ready will get call
  ngOnInit() {
  
    //Body class chaged to applications
    this.product.login();
  
    //Select the element to load class
    this.firstContactFormSelector = this.el.nativeElement.querySelector("#firstContactFormId");
    this.briefAssesmentFormSelector = this.el.nativeElement.querySelector("#briefAssesmentFormId");
    this.detailedPresentationFormSelector = this.el.nativeElement.querySelector("#detailedPresentationFormId");
    
    //Form disable
    this.formsDisable();

    this.blockUI.stop();
    this.loader = "";

  }

  showTableList() {

    //Prepare this request for get logged user informations
    this.serverRequest = {
      'token' : localStorage.getItem('token'),
      'module' : 'userProfile',
      'action' : 'adminlist',
      'requestData' : { admint : true, loggedEmailId : this.emailId, } 
    }  

    this.loader = "Loading list for admin";
    this.blockUI.start(this.loader);

    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      console.log('RESPONSE : ', this.serverResponse);
      this.product.checkToken(this.serverResponse.responseData.token);
      this.blockUI.stop();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
      } else {
        //Admin process assigned
        this.userRequestList = this.serverResponse.responseData.userRequestList;
        this.userRequestListCount = this.serverResponse.responseData.userRequestListCount;
      }
    }, (error) => {
      this.blockUI.stop();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

  }

  showSelectedUserFormData(data) {

    //Prepare this request for get logged user informations
    this.serverRequest = {
      'token' : localStorage.getItem('token'),
      'module' : 'userProfile',
      'action' : this.action,
      'requestData' : data 
    }

    this.loader = "Loading form data for selected user";
    this.blockUI.start(this.loader);

    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      console.log('RESPONSE : ', this.serverResponse);
      this.product.checkToken(this.serverResponse.responseData.token);
      this.blockUI.stop();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
      } else {
        //Load basic data informations from server
        this.presentFormNo = this.serverResponse.responseData.presentFormNo;
        this.action = this.serverResponse.responseData.action;

        //Load form inforamtion from the server          
        this.firstContactValues = this.serverResponse.responseData.firstContactForm;
        this.briefAssesmentValues = this.serverResponse.responseData.briefAssesmentForm;
        this.detailedPresentationValues = this.serverResponse.responseData.detailedPresentationForm;
        this.finalApproval = this.serverResponse.responseData.finalApprovalForm;
        this.emailId = this.loggedProfile.email_id;

        //For approval process
        this.processUserId = this.serverResponse.responseData.processUserId;
        this.processEmailId = this.serverResponse.responseData.processEmailId;
        this.statusTrackingDetailsId = this.serverResponse.responseData.statusTrackingDetailsId;
        this.approvalBy = this.serverResponse.responseData.approvalBy;
        this.gisedId = this.serverResponse.responseData.gisedId;

        //Form open and close according to the user access
        this.firstContactFormClose = this.serverResponse.responseData.close.firstContactFormClose;
        if(this.firstContactFormClose == "CLOSE") {
          this.firstContactFormSelector.classList.add('completed');           
        }
        this.briefAssesmentFormClose = this.serverResponse.responseData.close.briefAssesmentFormClose;
        if(this.briefAssesmentFormClose == "CLOSE") {
          this.briefAssesmentFormSelector.classList.add('completed');           
        }
        this.detailedPresentationFormClose = this.serverResponse.responseData.close.detailedPresentationFormClose;
        if(this.detailedPresentationFormClose == "CLOSE") {
          this.detailedPresentationFormSelector.classList.add('completed');           
        }
        
      }
    }, (error) => {
      this.blockUI.stop();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

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

  viewUserForm(gisetFormNo, userEmailId) {

    let data = {
      userEmailId : userEmailId,
      gisedId : gisetFormNo,
      loggedEmailId : this.emailId,
      admin : true
    };

    this.feedBackForm.controls.userEmailId.setValue(userEmailId);

    this.action = "showuserform";
    this.showSelectedUserFormData(data);

    this.adminTableView = "CLOSE";
    this.adminFormView = "OPEN";

  }

  viewUserList() {

    this.feedBackForm.controls.userEmailId.setValue('');

    this.showTableList();

    console.log("userlistshow");
    this.adminFormView = "CLOSE";
    this.adminTableView = "OPEN";

  }

  formApprove(formNo) {

    let data = {
      presentFormNo : this.presentFormNo,
      userId : this.processUserId,
      userEmailId : this.processEmailId,
      gisedId : this.gisedId,                    
      statusTrackingDetailsId : this.statusTrackingDetailsId,
      approvalBy : this.approvalBy,
      process : 'APPROVE',
      mailerAction : 'approved',
      userMsg : 'Form approved mail send to user successfully',
      loggedEmailId : this.emailId
    };

    this.approverAction(data);  

  }

  formHold(formNo) {

    let data = {
      presentFormNo : this.presentFormNo,
      userId : this.processUserId,
      userEmailId : this.processEmailId,
      gisedId : this.gisedId,                    
      statusTrackingDetailsId : this.statusTrackingDetailsId,
      approvalBy : this.approvalBy,
      process : 'DRAFT',
      mailerAction : 'drafted',
      userMsg : 'Form save in draft mail send to user successfully',
      loggedEmailId : this.emailId,
      approverReason : this.holdApprovalForm.value
    };

    this.approverAction(data); 

  }

  formReject(formNo) {

    let data = {
      presentFormNo : this.presentFormNo,
      userId : this.processUserId,
      userEmailId : this.processEmailId,
      gisedId : this.gisedId,                    
      statusTrackingDetailsId : this.statusTrackingDetailsId,
      approvalBy : this.approvalBy,
      process : 'REJECT',
      mailerAction : 'rejected',
      userMsg : 'Form rejected mail send to user successfully',
      loggedEmailId : this.emailId,
      approverReason : this.rejectApprovalForm.value
    };

    this.approverAction(data); 

  }

  holdReason() {

    this.formHold(0);
    this.closeModal('hold-modal');

  }

  rejectReason() {

    this.formReject(0);
    this.closeModal('reject-modal');

  }

  approverAction(data) {

    this.serverRequest = {
      'token' : localStorage.getItem('token'),
      'module' : 'application',
      'action' : 'approverprocess',
      'requestData' :  data
    }

    this.loader = "Changing the form status";
    this.blockUI.start(this.loader);

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      this.product.checkToken(this.serverResponse.responseData.token);
      this.blockUI.stop();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
      } else {
        this.presentFormNo = this.serverResponse.responseData.presentFormNo;        
        this.action = this.serverResponse.responseData.action;
        this.userMsg = this.serverResponse.responseData.userMsg;
        this.currentStatus = this.serverResponse.responseData.status;
        this.userMsg = this.serverResponse.responseData.userMsg;
        this.formsDisable();
        Swal.fire(this.userMsg);
      }
      this.holdApprovalForm.reset();
      this.rejectApprovalForm.reset();
    }, (error) => {
      this.blockUI.stop();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

  }

  feedBackFormSubmit() {

    this.feedBackForm.controls.loggedEmailId.setValue(this.emailId);

    this.serverRequest = {
      'token' : localStorage.getItem('token'),
      'module' : 'mailer',
      'action' : 'feedbackadmin',
      'requestData' :  this.feedBackForm.value 
    }

    this.loader = "Suggesstion mail sending to GISET user";
    this.blockUI.start(this.loader);

    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      this.product.checkToken(this.serverResponse.responseData.token);
      this.blockUI.stop();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        Swal.fire(this.errorMsg);
      } else {
        this.errorMsg = this.serverResponse.responseData.userMsg;
        Swal.fire(this.errorMsg);
        this.feedBackForm.reset();
      }
    }, (error) => {
      this.blockUI.stop();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

  }

  seeDetails($formNo) {

    if($formNo == 1) {
      if(this.firstContactFormClose == "OPEN") {
        this.firstContactFormClose = "CLOSE";
        this.firstContactFormSelector.classList.add('completed');
      } else if(this.firstContactFormClose == "CLOSE") {
        this.firstContactFormClose = "OPEN";
        this.firstContactFormSelector.classList.remove('completed');
      }
    } else if($formNo == 2) {
      if(this.briefAssesmentFormClose == "OPEN") {
        this.briefAssesmentFormClose = "CLOSE";
        this.briefAssesmentFormSelector.classList.add('completed');
      } else if(this.briefAssesmentFormClose == "CLOSE") {
        this.briefAssesmentFormClose = "OPEN";
        this.briefAssesmentFormSelector.classList.remove('completed');
      }
    } else if($formNo == 3) {
      if(this.detailedPresentationFormClose == "OPEN") {
        this.detailedPresentationFormClose = "CLOSE";
        this.detailedPresentationFormSelector.classList.add('completed');
      } else if(this.detailedPresentationFormClose == "CLOSE") {
        this.detailedPresentationFormClose = "OPEN";
        this.detailedPresentationFormSelector.classList.remove('completed');
      }
    } 

  }

  fileDownload(displayFile,downloadfile) {

    this.serverRequest = {
      'module' : 'download',
      'action' : 'download',
      'requestData' :  { filename : downloadfile } 
    }

    //this.loader = "Downloading file";
    //this.blockUI.stop();

    //Hit to the server for get logged user informations
    this.server.downloadFile(downloadfile).subscribe(blob => {
      importedSaveAs(blob, displayFile);
    });

  }

  //Edit Profile Image
  onSelectProfileImage(event) {
    if (event.target.files && event.target.files[0]) {
      var reader = new FileReader();
      reader.readAsDataURL(event.target.files[0]); // read file as data url
      reader.onload = (event) => { // called once readAsDataURL is completed
        let profileImg = reader.result;
        //console.log("base 64 :"+reader.result);
        
        this.serverRequest = {
          token: localStorage.getItem("token"),
          module: "userProfile",
          action: "profilephotoupload",
          requestData: { image : profileImg, emailId : this.emailId }
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
      }
    }
  }

  openModal(id: string) {
    this.modal.open(id);
  }

  closeModal(id: string) {
    this.modal.close(id);
  }

  //Edit Profile
  editProfileForm = new FormGroup({
    fullName: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.namePattern)
    ]),
    dob: new FormControl("", [Validators.required]),
    mobileNo: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.mobilePattern)
    ]),
    gender: new FormControl("", [Validators.required]),
    country: new FormControl(0, [Validators.required, Validators.min(1)]),
    applicationValues: new FormControl(''),
    image: new FormControl("", [Validators.required]),
    emailId: new FormControl(""),
  });

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

    this.loader = "Update your profile on GISET";
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
        this.closeModal('adminProfile-modal')
      },
      (error) => {
        this.blockUI.stop();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
        this.closeModal('userProfile-modal')
      },
      () => {
        console.log("Completed");
      }
    );
  }

}
