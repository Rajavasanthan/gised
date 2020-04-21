import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { ProductService } from '../../services/product.service';

import { AfterLoginRoutingModule } from '../../routes/after-login/after-login-routing.module';
import { AdminComponent } from '../../components/after-login/admin/admin.component';
import { UserComponent } from '../../components/after-login/user/user.component';

@NgModule({
  declarations: [
  AdminComponent,
  UserComponent],
  providers:[ProductService],
  imports: [
    CommonModule,
    AfterLoginRoutingModule
  ]
})
export class AfterLoginModule { }
