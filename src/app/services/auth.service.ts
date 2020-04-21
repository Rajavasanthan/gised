import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor() { 

  }

  checkLoginStatus() {
    if(!!localStorage.getItem('logged')) {
      return true;
    } else {
      return false;
    }
  }

}
