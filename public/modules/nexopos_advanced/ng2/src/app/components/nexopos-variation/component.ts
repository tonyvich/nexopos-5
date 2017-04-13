import { Component }        from '@angular/core';
import { MdDialogRef }      from '@angular/material';

@Component({
    moduleId    :   module.id,
    selector    :   'pos-item-variation',
    templateUrl :   'component.html'
})
export class NexoPosVariationComponent {
    constructor( public dialogRef: MdDialogRef<NexoPosVariationComponent>, item: any ) {

    }
}
