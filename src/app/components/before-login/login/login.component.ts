import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';

import { ValidationService } from '../../../services/validation.service';
import { ServerCallService } from '../../../services/server-call.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  serverRequest : any;
  serverResponse : any;
  errorMsg : string;

  loginForm = new FormGroup({
    emailId : new FormControl('', [Validators.required, Validators.email]),
    password : new FormControl('',[Validators.required, Validators.minLength(8)])
  });

  constructor(private server: ServerCallService, private router:Router) { 
    
  }

  ngOnInit() {
  }

  loginFormSubmit() {

    this.serverRequest = {
      'module' : 'login',
      'action' : 'logincheck',
      'requestData' : this.loginForm.value,
    }

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'EMPTY') {
        this.errorMsg = 'Sorry! Mail id not exist';
        alert(this.errorMsg);        
      } else if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        alert(this.errorMsg);
      } else {
        if(this.serverResponse.responseData == 'NOTSUCCESS') {
          this.errorMsg = 'Sorry! Invalid credentials';
          alert(this.errorMsg);
        } else {
          localStorage.setItem('logged', this.loginForm.controls.emailId.value);
          localStorage.setItem('emailId', this.loginForm.controls.emailId.value);
          console.log('Logged Sucessfully '+this.serverResponse.responseData.userTypeId);
          if(this.serverResponse.responseData.userTypeId == 1) {
            this.router.navigate(['/index/admin']);
          } else {
            this.router.navigate(['/index/user']);
          }
        }
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
      alert(this.errorMsg);
    }, () => {
      console.log('Completed');
    });
  }

}
