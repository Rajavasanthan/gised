import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { CommonModule,HashLocationStrategy, LocationStrategy  } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { HttpModule } from '@angular/http';
// import { NgxSpinnerModule } from "../../../../node_modules/ngx-spinner";

import { ValidationService } from '../../services/validation.service';
import { ServerCallService } from '../../services/server-call.service';
import { AuthService } from '../../services/auth.service';

import { BeforeLoginRoutingModule } from '../../routes/before-login/before-login-routing.module';

import { IndexComponent } from '../../components/before-login/index/index.component';
import { FooterComponent } from '../../components/before-login/footer/footer.component';
import { LoginComponent } from '../../components/before-login/login/login.component';
import { SingUpComponent } from '../../components/before-login/sing-up/sing-up.component';
import { ForgotPasswordComponent } from '../../components/before-login/forgot-password/forgot-password.component';
import { SetPasswordComponent } from '../../components/before-login/set-password/set-password.component';

@NgModule({
  declarations: [
    IndexComponent,
    FooterComponent,
    LoginComponent,
    SingUpComponent,
    ForgotPasswordComponent,
    SetPasswordComponent
  ],
  imports: [
    BrowserModule,
    CommonModule,
    ReactiveFormsModule,
    BeforeLoginRoutingModule,
    HttpClientModule,
    BrowserAnimationsModule,
    // NgxSpinnerModule,
    HttpModule
  ],
  providers: [{provide: LocationStrategy, useClass: HashLocationStrategy},ValidationService,ServerCallService,AuthService],
  bootstrap: [IndexComponent,FooterComponent]
})
export class BeforeLoginModule {

  

 }