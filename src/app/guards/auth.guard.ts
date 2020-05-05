import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { AuthService } from '../services/auth.service';
import { ProductService } from '../services/product.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  
  constructor(private router:Router, private authService : AuthService, private product : ProductService) {

  }

  canActivate() : boolean {
    if(this.authService.checkLoginStatus()) {
      return true;
    } else {
      this.product.checkToken('EMPTY');
      return true;
    }
  }
  
} 
