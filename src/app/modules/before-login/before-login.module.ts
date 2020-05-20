import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { NgModule } from '@angular/core';
import { CommonModule,HashLocationStrategy, LocationStrategy  } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';
import { HttpModule } from '@angular/http';
import { BlockUIModule } from 'ng-block-ui';
import { SocialLoginModule, AuthServiceConfig } from "angularx-social-login";
import { GoogleLoginProvider, FacebookLoginProvider } from "angularx-social-login";

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
import { Configurations } from "../../config/configurations";

let config = new AuthServiceConfig([
  {
    id: GoogleLoginProvider.PROVIDER_ID,
    provider: new GoogleLoginProvider(Configurations.GOOGLE_APP_ID)
  },
  {
    id: FacebookLoginProvider.PROVIDER_ID,
    provider: new FacebookLoginProvider(Configurations.FACEBOOK_APP_ID)
  }
]);
 
export function provideConfig() {
  return config;
}

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
    HttpModule,
    SocialLoginModule,
    BlockUIModule.forRoot()
  ],
  providers: [{provide: LocationStrategy, useClass: HashLocationStrategy},{ provide: AuthServiceConfig, useFactory: provideConfig }, ValidationService,ServerCallService,AuthService],
  bootstrap: [IndexComponent,FooterComponent]
})
export class BeforeLoginModule {

  

 }