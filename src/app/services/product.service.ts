import { Injectable, Renderer2, RendererFactory2 } from '@angular/core';
import { Router } from '@angular/router';
import { ServerCallService } from './server-call.service';

@Injectable({
  providedIn: 'root'
})
export class ProductService {

  private renderer: Renderer2;
  serverRequest : any;
  serverResponse : any;
  errorMsg : string;
  

  constructor(rendererFactory: RendererFactory2, private router: Router, private server:ServerCallService) { 

    this.renderer = rendererFactory.createRenderer(null, null);
  }

  showProfile() {
    this.serverRequest = {
      'module' : 'userProfile',
      'action' : 'showprofile',
      'requestData' : { 'emailId' : localStorage.getItem('logged') }
    } 

    this.server.sendToServer(this.serverRequest).
    subscribe((response) => {
      this.serverResponse = JSON.parse(this.server.decryption(response['response']));
      console.log('RESPONSE : ', JSON.stringify(this.serverResponse));
      if(this.serverResponse.responseData == 'ERROR') {
        this.errorMsg = 'Sorry! Something went wrong';
      } else {
       return  this.serverResponse.responseData;
      }
    }, (error) => {
      this.errorMsg = 'Sorry! Something went wrong';
    }, () => {
      console.log('Completed');
    });
  }

  logout() {
    this.renderer.removeClass(document.body, 'application__body');
    this.renderer.addClass(document.body, 'registration__body');

    localStorage.removeItem('logged');

    this.router.navigate(['/']);
  }

  login() {
    this.renderer.removeClass(document.body, 'registration__body');
    this.renderer.addClass(document.body, 'application__body');
  }

}
