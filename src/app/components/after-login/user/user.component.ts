//Need library files imported
import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { ServerCallService } from '../../../services/server-call.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
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
  userStatus : string;
  action : string;
  presentFormNo : number;
  firstContactValues : any;
  briefAssesmentValues : any;
  detailedPresentationValues : any;
  finalApproval : any;

  //Application form and variables declared
  applicationForm = new FormGroup({
    applicationValue : new FormControl('',[Validators.required])
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
    sourceValue : new FormControl('', [Validators.required]),
    otherSourceValue : new FormControl('', [Validators.required]),
    emailId : new FormControl(''),
    status : new FormControl(2)
  });

  //Constructor for this component
  constructor(private product:ProductService, private server:ServerCallService, private router: Router) { 
    
      //Define intial values to the variables
      this.loggedProfile = { title : '' };
      this.firstContactValues = { brief_idea : '', explained_idea : '', about_group : '' };

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
        if(this.serverResponse.responseData == 'ERROR') {
          this.errorMsg = 'Sorry! Something went wrong';
        } else {
          //Load the informations from server
          this.loggedProfile =  this.serverResponse.responseData.loggedProfile;
          this.applications = this.serverResponse.responseData.applications;
          this.source = this.serverResponse.responseData.sources;
          this.userStatus = this.serverResponse.responseData.status;
          this.presentFormNo = this.serverResponse.responseData.presentFormNo;
          this.action = this.serverResponse.responseData.action;
          if(this.presentFormNo == 1) {
            this.firstContactValues = this.serverResponse.responseData.firstContactForm;
            this.action = 'firstcontactforminsertion';
          } else if(this.presentFormNo == 2) {
            this.briefAssesmentValues = this.serverResponse.responseData.briefAssesmentForm;
          } else if(this.presentFormNo == 3) {
            this.detailedPresentationValues = this.serverResponse.responseData.detailedPresentationForm;
          } else if(this.presentFormNo == 4) {
            this.finalApproval = this.serverResponse.responseData.finalApprovalForm;
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
  
  }

  //Logout the logged user
  logout() {
    this.product.logout();
  }

  //First contact form insertion
  firstContactFormSubmit(){

    //Get logged user details
    this.firstContactForm.controls.emailId.setValue(localStorage.getItem('logged')) ;

    //Prepare this request for insert first contact form informations
    this.serverRequest = {
      'module' : 'application',
      'action' : this.action,
      'requestData' :  this.firstContactForm.value 
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
        this.errorMsg = 'First Contact created successfully. Wait for Review.';
        alert(this.errorMsg);
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
      alert(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

  }

  //Brief assesment form insertion
  briefAssesmentFormSubmit() {

    

  }

  //Detailed presentation form insertion
  detailedPresentaionFormSubmit() {



  }

  //Final approval form insertion
  finalApprovalFormSubmit() {



  }

  //Save present form values
  saveAsDraft() {

    //Check the conditions for which form present
    if(this.presentFormNo == 1) {
      this.firstContactForm.controls.status.setValue(3);
      this.firstContactFormSubmit();
    } else if(this.presentFormNo == 2) {
      this.briefAssesmentFormSubmit();
    } else if(this.presentFormNo == 3) {
      this.detailedPresentaionFormSubmit();
    } else if(this.presentFormNo == 4) {
      this.finalApprovalFormSubmit();
    }

  }

}
