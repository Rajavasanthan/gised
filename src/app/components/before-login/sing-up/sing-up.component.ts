import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

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

  signUpForm = new FormGroup({
    fullName : new FormControl('', [Validators.required]),
    emailId : new FormControl('', [Validators.required, Validators.email]),
    mobileNo : new FormControl('', [Validators.required]),
    gender : new FormControl('', [Validators.required]),
    age : new FormControl('', [Validators.required]),
    country : new FormControl('', [Validators.required])
  });

  constructor(private server: ServerCallService, private router: Router) { 

    this.serverRequest = {
      'module' : 'login',
      'action' : 'getcountries',
      'requestData' : '',
    } 

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
      } else {
        this.countries = this.serverResponse.responseData;
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
    }, () => {
      console.log('Completed');
    });

   }

  ngOnInit() {

    this.signUpForm.controls.country.setValue(0);

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

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', this.serverResponse);
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      } else {
        this.errorMsg = 'Account created successfully. Complete account creation check your mail to set password.';
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
