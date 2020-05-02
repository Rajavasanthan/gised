import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "../../../../../node_modules/ngx-spinner";
import Swal from "sweetalert2";

import { ValidationService } from '../../../services/validation.service';
import { ServerCallService } from '../../../services/server-call.service';

@Component({
  selector: 'app-forgot-password',
  templateUrl: './forgot-password.component.html',
  styleUrls: ['./forgot-password.component.css']
})
export class ForgotPasswordComponent implements OnInit {

  serverRequest : any;
  serverResponse : any;
  errorMsg : string;
  loader : string;

  forgotPasswordForm = new FormGroup({
    emailId : new FormControl('', [Validators.required, Validators.email])
  });

  constructor(private server: ServerCallService, private router: Router, private spinner: NgxSpinnerService) {

    this.loader = '';

   }

  ngOnInit() {

    /** spinner starts on init */
    // this.spinner.show();
 
    // setTimeout(() => {
    //   /** spinner ends after 5 seconds */
    //   this.spinner.hide();
    // }, 5000);

  }

  forgotPasswordFormSubmit() {

    this.serverRequest = {
      'module' : 'login',
      'action' : 'forgotpassword',
      'requestData' : this.forgotPasswordForm.value,
    } 

    this.loader = "Mail id checking and password reset link sending to your mail";
    this.spinner.show();

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', this.serverResponse);
      this.spinner.hide();
      this.loader = "Mail id checking and password reset link sending to your mail...";
      if(this.serverResponse.responseData == 'EMPTY') {
        this.errorMsg = 'Sorry! Mail id not exist';
        Swal.fire(this.errorMsg)
      } else if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
      } else {
        this.errorMsg = 'New password link sent to email successfully';
        alert(this.errorMsg);
      }
      this.router.navigate(['/']);
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
      alert(this.errorMsg);
      this.router.navigate(['/']);
    }, () => {
      console.log('Completed');
    });

  }

}
