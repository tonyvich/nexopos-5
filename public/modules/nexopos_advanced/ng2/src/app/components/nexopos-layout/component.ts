import { Component }                    from '@angular/core';
import { MdGridListModule }             from '@angular/material';

@Component({
    moduleId        :   module.id,
    selector        :   'pos',
    templateUrl     :   'component.html',
    styleUrls       :   [ 'component.css' ]
})
export class NexoPosLayoutComponent {
    documentHeight: number;

    constructor() {
        // excluding the margin
        this.documentHeight    =    window.innerHeight;
    }
}
