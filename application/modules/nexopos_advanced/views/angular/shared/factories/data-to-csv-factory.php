tendooApp.factory('sharedDataToCsv', function(){
        return {
            export:function( resource ){
                
                resource.get( function( data ){
                    var infos = "data:text/csv;charset=latin-1,\ufeff";
                    data.entries = angular.toJson( data.entries );
                    data.entries = JSON.parse ( data.entries );
                    
                    for (var i = 0; i < data.entries.length; i++) {
                        var row = "";
                        for (var index in data.entries[i]) {
                            row += '"' + data.entries[i][index] + '",';
                        }
                        row.slice(0, row.length - 1);
                        infos += row + '\r\n';
                    }

                    var encodedData = encodeURI( infos );
                    var body = angular.element(document.getElementsByTagName('body'))[0];
                    angular.element(body).append("<a id='ExportToCSV'></a>");
                    var link = angular.element(document.getElementById('ExportToCSV'));
                    link.attr('href',encodedData);
                    var fileName = name || ((new Date()).toLocaleDateString()+".csv");
                    link.attr('download',fileName);
                    link[0].click();
                    link.remove();
                });
            }
        }
    });