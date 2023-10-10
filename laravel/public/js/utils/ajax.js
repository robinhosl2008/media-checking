class Ajax {
    constructor() {}
    
    async fazRequisicao(formData = null, link = null, method = null, callback = null) {
        if (link) {
            return new Promise(resolve => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (method == null || method == 'POST') {
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
                }
            
                $.ajax({
                    type: (method) ?? 'POST',
                    url: link,
                    cache: false,
                    processData: false,  
                    contentType: false,
                    data: formData,
                    success: function(data) {
                        if (callback) {
                            if (data['status'] == false) {
                                let alerts = new Alerts;
                                alerts.exibeAlerta('info', `A concessionaria '${concessionariaNome}' não foi removida.`);
                            } else if (data['status'] == true) {
                                callback(data);
                            }
                        } else {
                            return resolve(data);
                        }
                    }
                });
            });
        }
    }
}