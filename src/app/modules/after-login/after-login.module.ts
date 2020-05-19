import { NgModule } from '@angular/core';
import { CommonModule, LocationStrategy, HashLocationStrategy } from '@angular/common';
import { BlockUIModule } from 'ng-block-ui';

import { ProductService } from '../../services/product.service';

import { AfterLoginRoutingModule } from '../../routes/after-login/after-login-routing.module';
import { AdminComponent } from '../../components/after-login/admin/admin.component';
import { UserComponent } from '../../components/after-login/user/user.component';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { ModalModule } from '../../modal';

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
    ModalModule,
    BlockUIModule.forRoot()
  ]
})
export class AfterLoginModule { }
