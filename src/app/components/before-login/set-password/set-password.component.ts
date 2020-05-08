import { Component, OnInit } from "@angular/core";
import { ActivatedRoute, Router } from "@angular/router";
import {
  FormGroup,
  FormControl,
  Validators,
  AbstractControl,
} from "@angular/forms";
// import { NgxSpinnerService } from "../../../../../node_modules/ngx-spinner";
import Swal from "sweetalert2";

import { ValidationService } from "../../../services/validation.service";
import { ServerCallService } from "../../../services/server-call.service";

@Component({
  selector: "app-set-password",
  templateUrl: "./set-password.component.html",
  styleUrls: ["./set-password.component.css"],
})
export class SetPasswordComponent implements OnInit {
  serverRequest: any;
  serverResponse: any;
  errorMsg: string;
  emailId: string;
  userId: number;
  loader: string;

  setPasswordForm = new FormGroup(
    {
      password: new FormControl("", [
        Validators.required,
        Validators.pattern(this.validation.passwordPattern),
      ]),
      confirmPassword: new FormControl("", [Validators.required]),
    },
    this.checkPasswords
  );

  constructor(
    private route: ActivatedRoute,
    private server: ServerCallService,
    private router: Router,
    // private spinner: NgxSpinnerService,
    private validation: ValidationService
  ) {
    this.route.params.subscribe((params) => {
      console.log(JSON.stringify(params));
      this.serverRequest = {
        module: "login",
        action: "setpassword",
        requestData: { link: params.link },
      };

      this.loader = "Preparing set password page";
      //this.spinner.show();

      this.server.sendToServer(this.serverRequest).subscribe(
        (response) => {
          this.serverResponse = JSON.parse(
            this.server.decryption(response["response"])
          );
          console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
          //this.spinner.hide();
          this.loader = "";
          if (this.serverResponse.responseData.result == "EMPTY") {
            this.errorMsg = "Sorry! Bad link";
            Swal.fire(this.errorMsg);
            this.router.navigate(["/"]);
          } else if (this.serverResponse.responseData.result == "ERROR") {
            this.errorMsg = "Sorry! Something went wrong";
            Swal.fire(this.errorMsg);
            this.router.navigate(["/"]);
          } else {
            this.emailId = this.serverResponse.responseData.emailId;
            this.userId = this.serverResponse.responseData.userId;
          }
        },
        (error) => {
          //this.spinner.hide();
          this.loader = "";
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
          this.router.navigate(["/"]);
        },
        () => {
          console.log("Completed");
        }
      );
    });
  }

  ngOnInit() {}

  setPasswordFormSubmit() {
    this.serverRequest = {
      module: "login",
      action: "updatepassword",
      requestData: {
        userId: this.userId,
        emailId: this.emailId,
        password: this.setPasswordForm.controls.password.value,
      },
    };

    this.loader = "Updating the changed passowrd";
    //this.spinner.show();

    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        //this.spinner.hide();
        this.loader = "";
        if (this.serverResponse.responseData == "EMPTY") {
          this.errorMsg = "Sorry! Mail id not exist";
          Swal.fire(this.errorMsg);
          this.router.navigate(["/"]);
        } else if (this.serverResponse.responseData == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
          this.router.navigate(["/"]);
        } else {
          this.errorMsg = "Password updated successfully";
          Swal.fire(this.errorMsg);
          this.router.navigate(["/"]);
        }
      },
      (error) => {
        //this.spinner.hide();
        this.loader = "";
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
        this.router.navigate(["/"]);
      },
      () => {
        console.log("Completed");
      }
    );
  }

  /*************************** Validation works ******************************/
  passName: string;

  passwordErr: String;
  confirmPasswordErr: String;

  passwordCheckVal(val: any) {
    this.passwordErr = this.validation.passwordValidation(val);
    this.passName = val;
  }

  confirmPasswordCheckVal(val: any) {
    if (this.passName == val) {
      this.confirmPasswordErr = "";
    } else {
      this.confirmPasswordErr = "Confirm Passwords do not match.";
    }
  }
  
checkPasswords(group: FormGroup) { // here we have the 'passwords' group
const password = group.get('password');
const repassword = group.get('confirmPassword');
  // if no values, validated as true
  
  if (!password || !repassword) {
    return null;
  }
  // if values match, return null, else nomatch: true
  return password.value === repassword.value ? null : { nomatch: true }  
}
}
