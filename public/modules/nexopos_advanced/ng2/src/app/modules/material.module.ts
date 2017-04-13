import  { NgModule }            from '@angular/core';
import  { MaterialModule }      from '@angular/material';
import  {
    MdButtonModule,
    MdCheckboxModule,
    MdGridListModule
} from '@angular/material';

@NgModule({
    imports     :   [
        MdButtonModule,
        MdCheckboxModule
    ],
    exports      :   [
        MdButtonModule,
        MdCheckboxModule
    ]
})
export class MaterialModule {};
