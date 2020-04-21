import { Component, OnInit } from '@angular/core';
import { ProductService } from '../../../services/product.service';

@Component({
  selector: 'app-admin',
  templateUrl: './admin.component.html',
  styleUrls: ['./admin.component.css']
})
export class AdminComponent implements OnInit {

  constructor(private product:ProductService) {

   }

  ngOnInit() {
    this.product.login();
  }

  logout() {
    this.product.logout();
  }

}
