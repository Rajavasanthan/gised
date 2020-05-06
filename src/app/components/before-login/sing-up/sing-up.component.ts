import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "../../../../../node_modules/ngx-spinner";
import Swal from "sweetalert2";

import { ValidationService } from '../../../services/validation.service';
import { ServerCallService } from '../../../services/server-call.service';

@Component({
  selector: 'app-sing-up',
  templateUrl: './sing-up.component.html',
  styleUrls: ['./sing-up.component.css']
})
export class SingUpComponent implements OnInit {

  serverRequest : any;
  serverResponse : any;
  emailErrorMsg : string;
  errorMsg : string;
  countries : any;
  loader : string; 

  signUpForm = new FormGroup({
    fullName : new FormControl('', [Validators.required,Validators.pattern(this.validation.namePattern)]),
    emailId : new FormControl('', [Validators.required, Validators.pattern(this.validation.emailIdPattern)]),
    mobileNo : new FormControl('', [Validators.required,Validators.pattern(this.validation.mobilePattern)]),
    gender : new FormControl('', [Validators.required]),
    age : new FormControl('', [Validators.required,Validators.pattern(this.validation.agePattern)]),
    country : new FormControl(0, [Validators.required,Validators.min(1)])
  });

  constructor(private server: ServerCallService, private router: Router, private spinner: NgxSpinnerService,private validation:ValidationService) { 

    this.serverRequest = {
      'module' : 'login',
      'action' : 'getcountries',
      'requestData' : ''
    } 

    this.loader = "Preparing signup page";
    this.spinner.show();

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      this.spinner.hide();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        Swal.fire(this.errorMsg);
      } else {
        this.countries = this.serverResponse.responseData.countries;
      }
    }, (error) => {
      this.spinner.hide();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
    }, () => {
      console.log('Completed');
    });

   }

  ngOnInit() {

    //this.signUpForm.get('country').setValue('0');

  }

  checkEmailId() {
    
    if(this.signUpForm.controls.emailId.valid) {

      this.serverRequest = {
        'module' : 'login',
        'action' : 'mailidcheck',
        'requestData' : {'emailId' : this.signUpForm.controls.emailId.value }
      } 
  
      this.server.sendToServer(this.serverRequest).
      subscribe((response) => {
        this.serverResponse = JSON.parse(this.server.decryption(response['response']));
        console.log('RESPONSE : ', this.serverResponse);
        if(this.serverResponse.responseData.emailId) {
          this.emailErrorMsg = 'Sorry! Email id already exist';
        } else {
          this.emailErrorMsg = '';
        }
      }, (error) => {
        this.errorMsg = 'Sorry! Something went wrong';
      }, () => {
        console.log('Completed');
      });

    }
  
  }

  signUpFormSubmit() {

    this.serverRequest = {
      'module' : 'login',
      'action' : 'signup',
      'requestData' : this.signUpForm.value,
    } 

    this.loader = "Creating your profile on GISET";
    this.spinner.show();

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', this.serverResponse);
      this.spinner.hide();
      this.loader = "";
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        Swal.fire(this.errorMsg);
        this.router.navigate(['/']);
      } else {
        this.errorMsg = 'Account created successfully. Complete account creation check your mail to set password.';
        Swal.fire(this.errorMsg);
        this.router.navigate(['/']);
      }
    }, (error) => {
      this.spinner.hide();
      this.loader = "";
      this.errorMsg = 'Sorry! Something went wrong';
      Swal.fire(this.errorMsg);
      this.router.navigate(['/']);
    }, () => {
      console.log('Completed');
    });

  }

}
