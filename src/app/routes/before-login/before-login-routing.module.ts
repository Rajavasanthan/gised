import { NgModule } from "@angular/core";
import { Routes, RouterModule } from "@angular/router";
import { IndexComponent } from "../../components/before-login/index/index.component";
import { LoginComponent } from "../../components/before-login/login/login.component";
import { SingUpComponent } from "../../components/before-login/sing-up/sing-up.component";
import { ForgotPasswordComponent } from "../../components/before-login/forgot-password/forgot-password.component";
import { SetPasswordComponent } from "../../components/before-login/set-password/set-password.component";
import { AuthGuard } from "../../guards/auth.guard";

const routes: Routes = [
  {
    path: "",
    component: LoginComponent,
  },
  {
    path: "signup",
    component: SingUpComponent,
  },
  {
    path: "forgotpassword",
    component: ForgotPasswordComponent,
  },
  {
    path: "setpassword/:link",
    component: SetPasswordComponent,
  },
  {
    path: "index",
    loadChildren: () =>
      import("../../modules/after-login/after-login.module").then(
        (m) => m.AfterLoginModule
      ),
    canActivate: [AuthGuard],
  },
];

// {
//   path: "index",
//   loadChildren: () =>
//     import("../../modules/after-login/after-login.module").then(
//       (m) => m.AfterLoginModule
//     ),
//   canActivate: [AuthGuard],
// },

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class BeforeLoginRoutingModule {}
