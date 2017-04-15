import { Component }        from '@angular/core';
import { MdDialog, MdDialogRef } from '@angular/material';
import { NexoPosVariationComponent } from '../nexopos-variation/component';

@Component({
    selector    :   'nexopos-grid',
    moduleId    :   module.id,
    templateUrl :   'component.html',
    styleUrls   :   [ 'component.css' ]
})
export class NexoPosGridComponent {
    items: itemInterface[]      =   [];

    constructor(public dialog: MdDialog){
        for(let i=0; i<5; i++ ) {
            this.items.push({
                name    :   'item',
                price   :   100,
                quantity:   10,
                variations  :   [{
                    name    :   'item',
                    price   :   100,
                    quantity :  20
                },{
                    name    :   'variation 2',
                    price   :   120,
                    quantity :  20
                }]
            });
        }
    }

    /**
     *  check if an item has a variation
     *  @param item
     *  @return void
    **/

    checkVariation( item: itemInterface ) {
        // console.log( item );
        if( item.variations.length > 1 ) {
            let dialogResponse  =   this.dialog.open( new NexoPosVariationComponent(
                this.dialog,
                item
            ) );

            dialogResponse.afterClosed().subscribe( result => {
                // console.log( result );
            });
        }
    }


}

interface   itemInterface {
    name:       string,
    price:      number,
    quantity:   number,
    variations :  itemVariationInterface[]
}

interface   itemVariationInterface {
    name:   string,
    price:  number,
    quantity:   number,
}
