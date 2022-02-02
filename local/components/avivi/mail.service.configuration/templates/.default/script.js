if (typeof(AV) === "undefined")
{
    AV = {};
}

if (typeof(AV.MailSetting) === "undefined")
{
    AV.MailSetting = function ()
    {
        this._settings = {};
    }
    AV.MailSetting.prototype =
        {
            initialize: function (settings)
            {
                this._settings = settings ? settings : {};

                // add button handler
                document.getElementById(this.getSetting('addButton', '')).onclick = BX.delegate(this.addNewConfig, this);

                // remove button handler
                for(var i=0;i<document.querySelectorAll('.'+this.getSetting('removeButton', '')).length;i++) {
                    document.querySelectorAll('.' + this.getSetting('removeButton', ''))[i].onclick = BX.delegate(this.removeConfig, this);
                }

                // init table
                this.initEditableTable();
            },
            initEditableTable: function()
            {
                var _this = this;
                $.fn.editable.defaults.mode = 'inline';
                $('.standart-field').editable({
                    emptytext: _this.getSetting('emptyWord',''),
                    url: _this.getSetting('ajaxUrl',''),
                });
                $('.name').editable({
                    emptytext: _this.getSetting('emptyWord',''),
                    validate: function(v) {
                        if(!v) return _this.getSetting('fieldRequired','');
                    },
                    url: _this.getSetting('ajaxUrl',''),
                });
                $('.checkbox–editable').editable({
                    emptytext: _this.getSetting('emptyWord',''),
                    source: [
                        {value: 'Y', text: 'Y'},
                        {value: 'N', text: 'N'}
                    ],
                    url: _this.getSetting('ajaxUrl',''),
                })
            },
            addNewConfig: function (e){
                e.preventDefault();
                var _this = this;
                var oPopup = new BX.PopupWindow('av_payment_popup', window.body, {
                    content: '',
                    offsetTop : 0,
                    autoHide : false,
                    width: 520,
                    lightShadow : true,
                    closeIcon : true,
                    closeByEsc : false,
                    overlay: {
                        backgroundColor: 'black', opacity: '80'
                    },
                    buttons: [
                        addItem = new BX.PopupWindowButton({
                            id: "add_btn",
                            text: this.getSetting('addButtonText', ''),
                            className: "ui-btn ui-btn-success",
                            events: {click: function(){
                                var popup = this;
                                var form = document.querySelector('#new-config');
                                var formData = new FormData(form);
                                var newData = [];
                                for (var element of formData.entries()) {
                                    newData[element[0]] = element[1];
                                }
                                if(newData.name === ""){
                                    document.querySelector('#nameinput .ui-ctl-textbox').classList.add('ui-ctl-danger');
                                    document.querySelector('#nameinput').innerHTML +='<span class="error-text">'+_this.getSetting('emptyName','')+'</span>';
                                    return false;
                                }
                                BX.ajax({
                                    url: _this.getSetting('ajaxUrl',''),
                                    method: 'POST',
                                    data: {
                                        data: newData,
                                        action: 'new'
                                    },
                                    cache: false,
                                    onsuccess: function(response)
                                    {
                                        document.querySelector('#xeditable').innerHTML = response;
                                        _this.initEditableTable();
                                        popup.popupWindow.destroy();
                                    }
                                });
                            }}
                        }),
                        new BX.PopupWindowButton({
                            text: this.getSetting('cancelButtonText', ''),
                            className: "ui-btn ui-btn-link",
                            events: {click: function(){
                                    this.popupWindow.destroy();
                                }}
                        })
                    ],
                    events: {
                        onPopupClose: function(popupWindow) {
                            popupWindow.destroy();
                        }
                    }
                });
                oPopup.show();

                BX.ajax({
                    url: this.getSetting('contentUrl', ''),
                    method: 'GET',
                    dataType: 'html',
                    cache: false,
                    onsuccess: function(response)
                    {
                        oPopup.setContent(response);
                        _this.initEditableTable();
                    }
                });
            },
            removeConfig: function (e)
            {
                e.preventDefault();
                var _this = this;
                var id = BX.proxy_context.getAttribute('data-pk');
                BX.UI.Dialogs.MessageBox.show({
                    title: _this.getSetting('confirmTitle',''),
                    message: _this.getSetting('confirmMessage',''),
                    buttons: BX.UI.Dialogs.MessageBoxButtons.OK_CANCEL,
                    onOk: function (messageBox) {
                        BX.ajax({
                            url: _this.getSetting('ajaxUrl',''),
                            method: 'POST',
                            data: {
                                id: id,
                                action: 'delete'
                            },
                            cache: false,
                            onsuccess: function(response)
                            {
                                document.querySelector('#xeditable').innerHTML = response;
                                _this.initEditableTable();
                            }
                        });
                        messageBox.close();
                    },
                    onCancel: function (messageBox) {
                        messageBox.close();
                    },
                });
            },
            getSetting: function (name, defaultval)
            {
                return this._settings.hasOwnProperty(name) ? this._settings[name] : defaultval;
            },
            animStart: function () {
                $('#circularG').css('display', 'block');
            },
            animStop: function() {
                $('#circularG').css('display', 'none');
            }
        }

    AV.MailSetting.create = function(settings)
    {
        var self = new AV.MailSetting();
        self.initialize(settings);
        return self;
    };
}