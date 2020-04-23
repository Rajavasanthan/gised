import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';
import { ServerCallService } from '../../../services/server-call.service';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

  loggedProfile : any;
  applications : any;
  source : any;
  serverRequest : any;
  serverResponse : any;
  errorMsg : string;
  userStatus : string;

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
    otherSourceValue : new FormControl('', [Validators.required])
  });

  constructor(private product:ProductService, private server:ServerCallService, private router: Router) { 
    
      this.serverRequest = {
        'module' : 'userProfile',
        'action' : 'showprofile',
        'requestData' : { 'emailId' : localStorage.getItem('logged') }
      } 
  
      this.server.sendToServer(this.serverRequest).
      subscribe((response) => {
        this.serverResponse = JSON.parse(this.server.decryption(response['response']));
        console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
        if(this.serverResponse.responseData == 'ERROR') {
          this.errorMsg = 'Sorry! Something went wrong';
        } else {
          this.loggedProfile =  this.serverResponse.responseData.loggedProfile;
          this.applications = this.serverResponse.responseData.applications;
          //console.log("app :"+this.applications);
          this.source = this.serverResponse.responseData.sources;
          this.userStatus = this.serverResponse.responseData.status;
        }
      }, (error) => {
        this.errorMsg = 'Sorry! Something went wrong';
      }, () => {
        console.log('Completed');
      });
  

  }

  ngOnInit() {
    this.product.login();

    // this.loggedProfile$ = this.product.showProfile();
    //this.product.showProfile().;
  }

  logout() {
    this.product.logout();
  }

  firstContactSubmit(){

    //console.log(JSON.stringify(this.firstContactForm.value));
    this.serverRequest = {
      'module' : 'application',
      'action' : 'firstContact',
      'requestData' : this.firstContactForm.value,
    } 

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      } else {
        this.errorMsg = 'First Contact created successfully. Wait for Review.';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
      alert(this.errorMsg);
      this.router.navigate(['/']);
    }, () => {
      console.log('Completed');
    });
  }

}
