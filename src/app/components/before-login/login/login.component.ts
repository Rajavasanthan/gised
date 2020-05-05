import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { NgxSpinnerService } from "../../../../../node_modules/ngx-spinner";
import Swal from "sweetalert2";

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
  loader : string; 

  loginForm = new FormGroup({
    emailId : new FormControl('', [Validators.required, Validators.pattern(this.validation.emailIdPattern)]),
    password : new FormControl('',[Validators.required, Validators.minLength(8)])
  });

  constructor(private server: ServerCallService, private router:Router, private spinner: NgxSpinnerService,private validation:ValidationService) { 
    

  }

  ngOnInit() {
  }

  loginFormSubmit() {

    this.serverRequest = {
      'module' : 'login',
      'action' : 'logincheck',
      'requestData' : this.loginForm.value,
    }

    this.loader = "Checking credentials";
    this.spinner.show();

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      this.spinner.hide();
      this.loader = "";
      if(this.serverResponse.responseData.status == 'EMPTY') {
        this.errorMsg = 'Sorry! Mail id not exist';
        Swal.fire(this.errorMsg);
      } else if(this.serverResponse.responseData.status == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
        Swal.fire(this.errorMsg);
      } else {
        if(this.serverResponse.responseData.status == 'NOTSUCCESS') {
          this.errorMsg = 'Sorry! Invalid credentials';
          Swal.fire(this.errorMsg);
        } else {
          localStorage.setItem('token', this.serverResponse.responseData.token);
          console.log('Logged Sucessfully '+this.serverResponse.responseData.userTypeId);
          
          if(this.serverResponse.responseData.userTypeId == 1) {
            this.router.navigate(['/index/admin']);
          } else {
            this.router.navigate(['/index/user']);
          }
        }
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

}
