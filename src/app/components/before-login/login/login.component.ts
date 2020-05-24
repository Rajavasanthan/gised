import { Component, OnInit } from "@angular/core";
import { FormGroup, FormControl, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { BlockUI, NgBlockUI } from 'ng-block-ui';
import Swal from "sweetalert2";

import { ValidationService } from "../../../services/validation.service";
import { ServerCallService } from "../../../services/server-call.service";

import { AuthService } from 'angularx-social-login';
import { SocialUser } from 'angularx-social-login';
import { GoogleLoginProvider, FacebookLoginProvider } from 'angularx-social-login';
import { take } from 'rxjs/operators';

@Component({
  selector: "app-login",
  templateUrl: "./login.component.html",
  styleUrls: ["./login.component.css"],
})
export class LoginComponent implements OnInit {

  @BlockUI() blockUI: NgBlockUI;

  serverRequest: any;
  serverResponse: any;
  errorMsg: string;
  loader: string;
  socialType : string;
  user : SocialUser;

  loginForm = new FormGroup({
    emailId: new FormControl("", [
      Validators.required,
      Validators.pattern(this.validation.emailIdPattern),
    ]),
    password: new FormControl("", [
      Validators.required,
      Validators.minLength(8),
    ]),
  });

  constructor(
    private server: ServerCallService,
    private router: Router,
    private validation: ValidationService,
    private authService: AuthService
  ) {}

  ngOnInit() {

  }

  socialProfileCheck() {

    this.serverRequest = {
      module: "login",
      action: "mailidcheck",
      requestData: { emailId: this.user.email }
    };

    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", this.serverResponse);
        if (this.serverResponse.responseData.emailId != "" && this.serverResponse.responseData.emailId == this.user.email) {
          Swal.fire("Sorry! Email id already exist");
        } else {
          this.socialProfileCreation();
        }
      },
      (error) => {
        this.errorMsg = "Sorry! Something went wrong";
      },
      () => {
        console.log("Completed");
      }
    );

  }

  socialProfileCreation() {

      let data = {
        fullName : this.user.name,
        emailId : this.user.email,
        mobileNo : 0,
        gender : 'Nil',
        age : 0,
        country : 1,
        social : this.user,
        socialType : this.socialType 
      };

      this.serverRequest = {
        module: "login",
        action: "signup",
        requestData: data
      };

      this.loader = "Creating your profile on GISED";
      this.blockUI.start(this.loader);

      this.server.sendToServer(this.serverRequest).subscribe(
        (response) => {
          this.serverResponse = JSON.parse(
            this.server.decryption(response["response"])
          );
          console.log("RESPONSE : ", this.serverResponse);
          this.blockUI.stop();
          this.loader = "";
          if (this.serverResponse.responseData == "ERROR") {
            this.errorMsg = "Sorry! Something went wrong";
            Swal.fire(this.errorMsg);
            this.router.navigate(["/"]);
          } else {
            this.errorMsg =
              "Account created successfully. Complete account creation check your mail to set password.";
            Swal.fire(this.errorMsg);
            this.router.navigate(["/"]);
          }
        },
        (error) => {
          this.blockUI.stop();
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

  signInWithGoogle(): void {

    this.authService.signIn(GoogleLoginProvider.PROVIDER_ID).then(()=>{
      this.authService.authState.pipe(take(1)).subscribe((response) => {
        this.socialType = "GOOGLE";
        this.user = response;
        console.log(JSON.stringify(this.user));
        console.log(JSON.stringify(this.user.email));
        console.log(response);
        this.socialProfileCheck();        
      },(error) => {
      },() => {
      });
    });

  }

  signInWithFB(): void {

    this.authService.signIn(FacebookLoginProvider.PROVIDER_ID).then(()=>{
      this.authService.authState.pipe(take(1)).subscribe((user) => {
        this.socialType = "FACEBOOK";
        this.user = user;
        console.log(JSON.stringify(this.user));
        this.socialProfileCheck();        
      },(error) => {
      },() => {
        this.signOut();
      }
    )});
  }

  signOut(): void {
    this.authService.signOut();
  }

  loginFormSubmit() {
    this.serverRequest = {
      module: "login",
      action: "logincheck",
      requestData: this.loginForm.value,
    };

    this.loader = "Checking credentials";
    this.blockUI.start(this.loader);

    this.server.sendToServer(this.serverRequest).subscribe(
      (response) => {
        this.serverResponse = JSON.parse(
          this.server.decryption(response["response"])
        );
        console.log("RESPONSE : ", JSON.stringify(this.serverResponse));
        this.loader = "";
        this.blockUI.stop();
        if (this.serverResponse.responseData.status == "EMPTY") {
          this.errorMsg = "Sorry! Mail id not exist";
          Swal.fire(this.errorMsg);
        } else if (this.serverResponse.responseData.status == "ERROR") {
          this.errorMsg = "Sorry! Something went wrong";
          Swal.fire(this.errorMsg);
        } else {
          if (this.serverResponse.responseData.status == "NOTSUCCESS") {
            this.errorMsg = "Sorry! Invalid credentials";
            Swal.fire(this.errorMsg);
          } else {
            localStorage.setItem(
              "token",
              this.serverResponse.responseData.token
            );
            console.log(
              "Logged Sucessfully " +
                this.serverResponse.responseData.userTypeId
            );

            if (this.serverResponse.responseData.userTypeId == 1) {
              this.router.navigate(["/index/admin"]);
            } else {
              this.router.navigate(["/index/user"]);
            }
          }
        }
      },
      (error) => {
        this.loader = "";
        this.blockUI.stop();
        this.errorMsg = "Sorry! Something went wrong";
        Swal.fire(this.errorMsg);
      },
      () => {
        console.log("Completed");
      }
    );
  }
}
