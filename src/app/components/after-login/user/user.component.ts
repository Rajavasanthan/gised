//Need library files imported
import { Component, OnInit, ElementRef } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { ServerCallService } from '../../../services/server-call.service';
import { FormGroup, FormControl, Validators, FormArray } from '@angular/forms';
import { Router } from '@angular/router';

//Specifid the this component schema
@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})

//Class implmentation for this component
export class UserComponent implements OnInit {

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

  //Application form and variables declared
  applicationForm = new FormGroup({
    applicationValue : new FormControl('1',[Validators.required])
  });

  //Feed back form and variables declared
  feedBackForm = new FormGroup({
    feedback : new FormControl('',[Validators.required])
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
    status : new FormControl(2)
  });

  //Detailed presentation form and variables declared
  detailedPresentaionForm = new FormGroup({
    purposeOfProject1 : new FormControl('',[Validators.required]),
    detailedInformation : new FormControl('',[Validators.required]),
    estimatedBudget : new FormControl('',[Validators.required]),
    periodOfTime : new FormControl('',[Validators.required]),
    purposeOfProject2 : new FormControl('',[Validators.required]),
    emailId : new FormControl(''),
    status : new FormControl(2)
  });

  //Final approval form and variables declared
  finalApprovalForm = new FormGroup({
    submitButton : new FormControl(''),
    emailId : new FormControl(''),
    status : new FormControl(2)
  });

  //Constructor for this component
  constructor(private product:ProductService, private server:ServerCallService, private router: Router, private el: ElementRef) { 
    
      //Define intial values to the variables
      this.currentStatus = 'Nil';
      this.loggedProfile = { title : '' };
      this.firstContactFormClose = "OPEN";
      this.briefAssesmentFormClose = "OPEN";
      this.detailedPresentationFormClose = "OPEN";
      this.firstContactValues = { brief_idea : '', explained_idea : '', about_group : '', first_name : '', last_name : '', email_id : '', organization_name : '', org_details : '', sign_up_for_emails : 'N', r_source_id : { pressads : false } };

      //Prepare this request for get logged user informations
      this.serverRequest = {
        'module' : 'userProfile',
        'action' : 'showprofile',
        'requestData' : { 'emailId' : localStorage.getItem('logged') }
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
          //Load basic data informations from server
          this.loggedProfile =  this.serverResponse.responseData.loggedProfile;
          this.applications = this.serverResponse.responseData.applications;
          this.currentStatus = this.serverResponse.responseData.status;
          this.presentFormNo = this.serverResponse.responseData.presentFormNo;
          this.action = this.serverResponse.responseData.action;

          //Load form inforamtion from the server          
          this.firstContactValues = this.serverResponse.responseData.firstContactForm;
          this.briefAssesmentValues = this.serverResponse.responseData.briefAssesmentForm;
          this.detailedPresentationValues = this.serverResponse.responseData.detailedPresentationForm;
          this.finalApproval = this.serverResponse.responseData.finalApprovalForm;
   
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
          
          //Open form for initial action
          if(this.action == 'firstcontactforminsertion') {
            this.firstContactForm.enable();
          } else if(this.action == 'briefassesmentforminsertion') {
            this.briefAssesmentForm.enable();
          } else if(this.action == 'detailedpresentationforminsertion') {
            this.detailedPresentaionForm.enable();
          } 

        }
      }, (error) => {
        this.errorMsg = 'Sorry! Something went wrong';
      }, () => {
        console.log('Completed');
      });

  }

  //After dom ready will get call
  ngOnInit() {
  
    //Body class chaged to applications
    this.product.login();
  
    //this.selectedApplication = 1;
    //this.applicationForm.controls.applicationValue.setValue(1);
    this.applicationForm.get('applicationValue').setValue(1);

    //Select the element to load class
    this.firstContactFormSelector = this.el.nativeElement.querySelector("#firstContactFormId");
    this.briefAssesmentFormSelector = this.el.nativeElement.querySelector("#briefAssesmentFormId");
    this.detailedPresentationFormSelector = this.el.nativeElement.querySelector("#detailedPresentationFormId");
    
    //Form disable
    this.formsDisable();

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

  feedBackFormSubmit() {

    this.serverRequest = {
      'module' : 'mailer',
      'action' : 'feedback',
      'requestData' :  this.feedBackForm.value 
    }

    //Hit to the server for get logged user informations
    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
      } else {
        this.errorMsg = this.serverResponse.responseData.userMsg;
        alert(this.errorMsg);

      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
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

  //Form submission
  formSubmit(data) {

    //Get logged user details
    data.emailId = localStorage.getItem('logged');

    //Prepare this request for insert first contact form informations
    this.serverRequest = {
      'module' : 'application',
      'action' : this.action,
      'requestData' :  data  
    } 
    //Hit to the server for insert first contact form informations
    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
      } else {
        this.presentFormNo = this.serverResponse.responseData.presentFormNo;        
        this.action = this.serverResponse.responseData.action;
        this.userMsg = this.serverResponse.responseData.userMsg;
        this.currentStatus = this.serverResponse.responseData.status;
        this.formsDisable();
        if(this.action == 'briefassesmentforminsertion') {
          this.briefAssesmentForm.enable();
        } else if(this.action == 'detailedpresentationforminsertion') {
          this.detailedPresentaionForm.enable();
        }
        alert(this.userMsg);
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
      alert(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

  }

  firstContactFormInsert() {

    if(this.presentFormNo == 0) {
      alert("Till get approve, You cant proceed with another form");
      return false;
    }

    this.firstContactForm.controls.status.setValue(2);
    this.formSubmit(this.firstContactForm.value);

  }


  //Brief assesment form insertion
  briefAssesmentFormInsert() {

    if(this.presentFormNo == 0) {
      alert("Till get approve, You cant proceed with another form");
      return false;
    }

    this.briefAssesmentForm.controls.status.setValue(2);
    this.formSubmit(this.briefAssesmentForm.value);

  }

  //Detailed presentation form insertion
  detailedPresentaionFormInsert() {

    if(this.presentFormNo == 0) {
      alert("Till get approve, You cant proceed with another form");
      return false;
    }

    this.detailedPresentaionForm.controls.status.setValue(2);
    this.formSubmit(this.detailedPresentaionForm.value);

  }

  //Detailed presentation form insertion
  finalApprovalFormInsert() {

    if(this.presentFormNo == 0) {
      alert("Till get approve, You cant proceed with another form");
      return false;
    }

    this.finalApprovalForm.controls.status.setValue(2);
    this.formSubmit(this.finalApprovalForm.value);

  }

  //Save present form values
  saveAsDraft() {

    //Check the conditions for which form present
    if(this.presentFormNo == 1) {
      this.firstContactForm.controls.status.setValue(3);
      this.formSubmit(this.firstContactForm.value);
    } else if(this.presentFormNo == 2) {
      this.briefAssesmentForm.controls.status.setValue(3);
      this.formSubmit(this.briefAssesmentForm.value);
    } else if(this.presentFormNo == 3) {
      this.detailedPresentaionForm.controls.status.setValue(3);
      this.formSubmit(this.detailedPresentaionForm.value);
    } else {
      alert("Till get approve, You cant proceed with another form");
    }

  }

  //Edit present form
  editForm() {

    //Check the conditions for which form present
    if(this.presentFormNo == 1) {
      this.firstContactForm.enable();
    } else if(this.presentFormNo == 2) {
      this.briefAssesmentForm.enable();
    } else if(this.presentFormNo == 3) {
      this.detailedPresentaionForm.enable();
    } else {
      alert("Till get approve, You cant proceed with another form");
    }   

  }

  //Share the form according to the action
  shareDetails($formNo) {

    if($formNo == 1) {
      let divContents = document.getElementById("firstContactFormId").innerHTML; 
      let a = window.open('', '', 'height=500, width=500'); 
      a.document.write('<html>'); 
      a.document.write('<body>'); 
      a.document.write(divContents); 
      a.document.write('</body></html>'); 
      a.document.close();
      a.print(); 
    }

  }

  getSelectedFileList(event) {

    if (event.target.files && event.target.files[0]) {
      let filesCount = event.target.files.length;
      console.log(event.target);
      console.log(event.target.files);
      for (let i = 0; i < filesCount; i++) {
        console.log(event.target.result);
              // var reader = new FileReader();
              // reader.onload = (event:any) => {
              //   console.log(event.target.result);
              //    this.urls.push(event.target.result); 
              // }
              // reader.readAsDataURL(event.target.files[i]);
      }
    }

  }

}
