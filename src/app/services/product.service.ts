import { Injectable, Renderer2, RendererFactory2, ElementRef } from '@angular/core';
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
  modal : any;
  progressBar : any;  
  progressMessage : any;

  constructor(rendererFactory: RendererFactory2, private router: Router, private server:ServerCallService) { 

    this.renderer = rendererFactory.createRenderer(null, null);
    // this.modal = this.el.nativeElement.querySelector(".modal");
    // this.progressBar = this.el.nativeElement.querySelector("#progressBar");
    // this.progressMessage = this.el.nativeElement.querySelector("#progressMessage");
    //var trigger = this.el.nativeElement.querySelector(".trigger");
    //var closeButton = this.el.nativeElement.querySelector(".close-button");

  }

  productLoader(action, message) {
    
    if(action == "SHOW") {
      //this.progressMessage.innerHTML = message;
      this.modal.classList.add('show-modal');
      //document.getElementById('popup').classList.add("show-modal");
      //this.renderer.addClass(document.getElementById('popup'), 'show-modal');
    } else {
      //this.progressMessage.innerHTML = '';
      //this.modal.classList.remove('show-modal');
    }

  }

  productAlert(action, message) {

    if(action == "SHOW") {
      //this.modal.classList.add('show-modal');
      this.renderer.addClass(document.getElementById('popup'), 'show-modal');
    } else {
      this.modal.classList.remove('show-modal');
    }

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
