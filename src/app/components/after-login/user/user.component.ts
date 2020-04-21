import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

  loggedProfile : any;

  constructor(private product:ProductService) { 
    
  }

  ngOnInit() {
    this.product.login();

    this.loggedProfile = this.product.showProfile();
  }

  logout() {
    this.product.logout();
  }

}
