import { NgModule } from '@angular/core';
import { CommonModule, LocationStrategy, HashLocationStrategy } from '@angular/common';
// import { NgxSpinnerModule } from "../../../../node_modules/ngx-spinner";

import { ProductService } from '../../services/product.service';

import { AfterLoginRoutingModule } from '../../routes/after-login/after-login-routing.module';
import { AdminComponent } from '../../components/after-login/admin/admin.component';
import { UserComponent } from '../../components/after-login/user/user.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [
  AdminComponent,
  UserComponent],
  providers:[{provide: LocationStrategy, useClass: HashLocationStrategy},ProductService],
  imports: [
    CommonModule,
    AfterLoginRoutingModule,
    FormsModule,
    ReactiveFormsModule,
    // NgxSpinnerModule
  ]
})
export class AfterLoginModule { }
