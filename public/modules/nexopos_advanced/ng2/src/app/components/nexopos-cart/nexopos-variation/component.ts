import { Component }    from '@angular/core';

@Component({
    moduleId    :   module.id,
    selector    :   'pos-item-variation',
    templateUrl :   'variation.component.html'
})
export class NexoPOSVariationComponent {
    constructor( public dialogRef: MdDialogRef<NexoPOSVariationComponent> ) {}
}
