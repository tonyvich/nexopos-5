import { NgModule }                 from '@angular/core';
import { BrowserModule }            from '@angular/platform-browser';
import { FormsModule }              from '@angular/forms';
import { RouterModule, Routes }     from '@angular/router';
import { MaterialModule }           from '@angular/material';
import { BrowserAnimationsModule }  from '@angular/platform-browser/animations';
import { FlexLayoutModule }         from '@angular/flex-layout';

import {
    HammerGestureConfig,
    HAMMER_GESTURE_CONFIG
} from '@angular/platform-browser';

import { AppComponent }                 from './app.component';
import { NexoPosLayoutComponent }       from './components/nexopos-layout/component';
import { NexoPosCartComponent }         from './components/nexopos-cart/component';
import { NexoPosGridComponent }         from './components/nexopos-grid/component';
import { NexoPosVariationComponent }    from './components/nexopos-variation/component';

const appRoutes: Routes             =   [
    { path : '', component : NexoPosLayoutComponent }
]

@NgModule({
  imports:      [
      BrowserModule,
      FormsModule,
      RouterModule.forRoot( appRoutes ),
      BrowserAnimationsModule,
      MaterialModule.forRoot(),
      FlexLayoutModule
  ],
  declarations: [
      AppComponent,
      NexoPosLayoutComponent,
      NexoPosCartComponent,
      NexoPosGridComponent,
      NexoPosVariationComponent
  ],
  bootstrap:    [ AppComponent ],
  entryComponents :   [
      NexoPosVariationComponent
  ]
})

export class AppModule { }
