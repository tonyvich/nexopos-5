var data: string[]  =   [ 'Bonjour', 'Bonsoir' ];
console.log( data );

var filter  =   function( value: string ): string {
    return value + 1;
}

interface human {
    strengh     :   number;
    name        :   string;
    move(y: number, x: number)      :   void;
}

var noah: human = {
    strengh     :   20,
    name        :   'Noah',
    move        :   function( y:number, x:number ) {

    }    
}
