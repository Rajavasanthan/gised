import { Injectable } from "@angular/core";

@Injectable({
  providedIn: "root",
})
export class ValidationService {
  validationStatus: boolean;
  emailIdPattern: any;
  passwordPattern: any;
  namePattern: any;
  mobilePattern: any;
  telePhonePattern: any;
  dob: any;
  descriptionPattern: any;
  organizationPattern: any;

  constructor() {
    this.validationStatus = true;
    this.emailIdPattern = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    this.passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*?&])[A-Za-z\d!@#$%^&*?&]{8,}$/;
    this.namePattern = /^[a-zA-Z ]{1,50}$/;
    this.organizationPattern = /^[a-zA-Z ]{1,70}$/;
    this.mobilePattern = /^[0][1-9]\d{9}$|^[1-9]\d{9}$/;
    this.telePhonePattern = /^\d{10,12}$/;
    // this.agePattern = /(?:\b|-)([1-9]{1,2}[0]?|100)\b/;
    this.dob = /^\d{4}-\d{2}-\d{2}$/;
    this.descriptionPattern = /^.{25,}$/;
  }

  /*minAndMaxError(min,max){

  }  */

  userNameCheckValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter User Name";
      return err;
    }

    var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (!regex.test(val)) {
      err = "Invalid Username.";
      return err;
    }
    return err;
  }

  nameValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter User Name";
      return err;
    }

    var regex = /^[a-zA-Z ]{1,50}$/;
    if (!regex.test(val)) {
      err = "Please Enter Only Characters";
      return err;
    }
    if (val.length < 2 || val.length > 50) {
      err = "Your Character must be 2 to 50 Character";
      return err;
    }

    return err;
  }

  mobileValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter Mobile Number";
      return err;
    }

    var regex = /[0-9]/;
    if (!regex.test(val)) {
      err = "Please Enter Only Number";
      return err;
    }
    if (val.length != 10) {
      err = "Your mobile number must be 10 digit";
      return err;
    }

    return err;
  }

  ageValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter your age";
      return err;
    }

    var regex = /^[0-9]$/;
    if (!regex.test(val)) {
      err = "Please Enter Only Number";
      return err;
    }
    if (val.length < 3) {
      err = "Please Enter Valid age";
      return err;
    }

    return err;
  }

  passwordCheckValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter Password";
      return err;
    }

    return err;
  }

  passwordValidation(val) {
    var err = "";

    /*if (val.length < 8) {
      err ="Your password must be at least 8 characters";
    }

    if (val.search(/[a-z]/i) < 0) {
      err ="should contain at least one lower case";
    }

    if (val.search(/[A-Z]/i) < 0) {
      err ="should contain at least one upper case";
    }

    if (val.search(/[0-9]/) < 0) {
      err ="should contain at least one digit.";
    }

    if (val.search(/[!@#$%^&*]/) < 0) {
      err ="should contain at least one Special characters.";
    }*/

    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (!val.match(lowerCaseLetters)) {
      err = "should contain at least one lower case.\n";
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (!val.match(upperCaseLetters)) {
      err = err + "should contain at least one upper case.\n";
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (!val.match(numbers)) {
      err = err + "\n" + "should contain at least one digit.\n";
    }

    // Validate Spacial character
    var chars = /[!@#$%^&*?&]/g;
    if (!val.match(chars)) {
      err = err + "\n" + "should contain at least one Spacial character.\n";
    }

    // Validate length
    if (!(val.length >= 8)) {
      err = err + "\n" + "Your password must be at least 8 characters.\n";
    }

    return err;
  }

  emailValidation(val) {
    var err = "";

    if (val == "") {
      err = "Enter Email id";
      return err;
    }

    var regex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (!regex.test(val)) {
      err = "Invalid email id.";
      return err;
    }
    return err;
  }
}
