import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from "@angular/router";
import { FormGroup, FormControl, Validators } from '@angular/forms';

import { ValidationService } from '../../../services/validation.service';
import { ServerCallService } from '../../../services/server-call.service';

@Component({
  selector: 'app-set-password',
  templateUrl: './set-password.component.html',
  styleUrls: ['./set-password.component.css']
})
export class SetPasswordComponent implements OnInit {

  serverRequest : any;
  serverResponse : any;
  errorMsg : string;
  emailId : string;
  userId : number;

  setPasswordForm = new FormGroup({
    password : new FormControl('', [Validators.required]),
    confirmPassword : new FormControl('', [Validators.required]),
  });


  constructor(private route: ActivatedRoute, private server: ServerCallService, private router: Router) { 
    this.route.params.subscribe( (params) => {
      
      console.log(JSON.stringify(params));
      this.serverRequest = {
        'module' : 'login',
        'action' : 'setpassword',
        'requestData' : { 'link' : params.link }
      }

      this.server.sendToServer(this.serverRequest).
      subscribe((response) => {
        this.serverResponse = JSON.parse(this.server.decryption(response['response']));
        console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
        if(this.serverResponse.responseData == 'EMPTY') {
          this.errorMsg = 'Sorry! Bad link';
          alert(this.errorMsg);
          this.router.navigate(['/']);
        } else if(this.serverResponse.responseData == 'ERROR') {
          this.errorMsg = 'Sorry! Something went wrong';
          alert(this.errorMsg);
          this.router.navigate(['/']);
        } else {
          this.emailId = this.serverResponse.responseData.emailId;
          this.userId = this.serverResponse.responseData.userId;
        }
      }, (error) => {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      }, () => {
        console.log('Completed');
      });

    });
   }

  ngOnInit() {
  }

  setPasswordFormSubmit() {

    this.serverRequest = {
      'module' : 'login',
      'action' : 'updatepassword',
      'requestData' : {
            'userId':this.userId,
            'emailId':this.emailId,
            'password': this.setPasswordForm.controls.password.value
      }
    } 

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'EMPTY') {
        this.errorMsg = 'Sorry! Mail id not exist';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      } else if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
        this.router.navigate(['/']);
      } else {
        this.errorMsg = 'Password updated successfully';
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
