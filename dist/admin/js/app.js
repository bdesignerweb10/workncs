$(function(){$("html, body").on("click",function(t){t.target==document.documentElement&&$("html").removeClass("open-sidebar")}),$(".js-open-sidebar").on("click",function(){$("html").addClass("open-sidebar")}),$("#logout").on("click",function(t){t.preventDefault(),$("#loading-modal").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.logout.php",success:function(t){try{$("#loading-modal").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?(document.cookie.split(";").forEach(function(t){document.cookie=t.replace(/^ +/,"").replace(/=.*/,"=;expires="+(new Date).toUTCString()+";path=/")}),window.location.href="./"):($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"),"12010"==a.errno&&$("#alert").on("hidden.bs.modal",function(t){window.location.href="provisoria"}))}catch(t){$("#loading-modal").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#form-login").submit(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.login.php?act=login",data:$("#form-login").serialize(),success:function(t){try{var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));$("#loading").modal("hide"),a.succeed?window.location.href="home":($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-login").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1}),$.ajax({type:"POST",url:"acts/acts.login.php?act=login",data:$("#form-login").serialize(),success:function(t){try{var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));$("#loading").modal("hide"),a.succeed?window.location.href="home":($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-add-curso").click(function(t){t.preventDefault(),$(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-curso").data("id",null),$("#btn-salvar-curso").data("act","add"),$("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").bootstrapToggle("off"),$("#destaque").bootstrapToggle("off"),$("#ativo").bootstrapToggle("off")}),$("#btn-voltar-curso").click(function(t){t.preventDefault(),$(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-curso").data("id",null),$("#headline-ger-curso").html(""),$(".headline-form").html(""),$("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").bootstrapToggle("off"),$("#destaque").bootstrapToggle("off"),$("#ativo").bootstrapToggle("off")}),$("#form-curso").submit(function(t){t.preventDefault(),$("#loading-modal").modal({keyboard:!1});var a=$("#btn-salvar-curso").data("id"),e=$("#btn-salvar-curso").data("act");if("edit"==e)var o="acts/acts.curso.php?act="+e+"&id="+a;else o="acts/acts.curso.php?act="+e;var r=new FormData;r.append("id",$("#id").val()),r.append("nome",$("#nome").val()),r.append("data_inicio",$("#data_inicio").val()),r.append("descricao",$("#descricao").val()),r.append("inscricao",document.getElementById("inscricao").checked?"0":"1"),r.append("destaque",document.getElementById("destaque").checked?"0":"1"),r.append("ativo",document.getElementById("ativo").checked?"0":"1"),$.ajax({type:"POST",url:o,data:r,processData:!1,contentType:!1,success:function(t){try{console.log(t),$("#loading-modal").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").val(""),$("#destaque").val(""),$("#ativo").val(""),$("#alert-title").html("Dados alterados com sucesso!"),$("#alert-content").html("Dados de clientes/parceiros registrados com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"),$("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").val(""),$("#destaque").val(""),$("#ativo").val(""))}catch(t){$("#loading-modal").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show"),$("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").val(""),$("#destaque").val(""),$("#ativo").val("")}}})}),$(".btn-edit-curso").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var e=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.curso.php?act=showupd&id="+e,success:function(t){try{$("#loading").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-curso").data("act","edit"),$("#btn-salvar-curso").data("id",e),$("#id").val(a.dados.id),$("#nome").val(a.dados.nome),$("#data_inicio").val(a.dados.data_inicio),$("#descricao").val(a.dados.descricao),$("#inscricao").bootstrapToggle(0==a.dados.inscricao?"on":"off"),$("#destaque").bootstrapToggle(0==a.dados.destaque?"on":"off"),$("#ativo").bootstrapToggle(0==a.dados.ativo?"on":"off")):($(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-curso").data("id",null),$("#btn-salvar-curso").data("act",null),$("#id").val(""),$("#nome").val(""),$("#data_inicio").val(""),$("#descricao").val(""),$("#inscricao").bootstrapToggle("off"),$("#destaque").bootstrapToggle("off"),$("#ativo").bootstrapToggle("off"),$("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$(".btn-del-curso").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var a=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.curso.php?act=del&id="+a,success:function(t){try{$("#loading").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($("#alert-title").html("Curso removido com sucesso!"),$("#alert-content").html("A remoção do curso foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$("#btn-add-consultoria").click(function(t){t.preventDefault(),$(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-consultoria").data("id",null),$("#btn-salvar-consultoria").data("act","add"),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#ativo").bootstrapToggle("off")}),$("#btn-voltar-consultoria").click(function(t){t.preventDefault(),$(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-consultoria").data("id",null),$("#headline-ger-consultoria").html(""),$(".headline-form").html(""),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#ativo").bootstrapToggle("off")}),$("#form-consultoria").submit(function(t){t.preventDefault(),$("#loading-modal").modal({keyboard:!1});var a=$("#btn-salvar-consultoria").data("id"),e=$("#btn-salvar-consultoria").data("act");if("edit"==e)var o="acts/acts.consultoria.php?act="+e+"&id="+a;else o="acts/acts.consultoria.php?act="+e;var r=new FormData;r.append("id",$("#id").val()),r.append("titulo",$("#titulo").val()),r.append("descricao",$("#descricao").val()),r.append("img",$("#img")[0].files[0]),r.append("ativo",document.getElementById("ativo").checked?"0":"1"),$.ajax({type:"POST",url:o,data:r,processData:!1,contentType:!1,success:function(t){try{console.log(t),$("#loading-modal").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#img").val(""),$("#ativo").val(""),$("#alert-title").html("Dados alterados com sucesso!"),$("#alert-content").html("Dados da consultoria registrados com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#img").val(""),$("#ativo").val(""))}catch(t){$("#loading-modal").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show"),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#img").val(""),$("#ativo").val("")}}})}),$(".btn-edit-consultoria").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var e=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.consultoria.php?act=showupd&id="+e,success:function(t){try{$("#loading").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($(".maintable").hide(),$(".mainform").show(),$("#btn-salvar-consultoria").data("act","edit"),$("#btn-salvar-consultoria").data("id",e),$("#id").val(a.dados.id),$("#titulo").val(a.dados.titulo),$("#descricao").val(a.dados.descricao),$("#ativo").bootstrapToggle(0==a.dados.ativo?"on":"off")):($(".mainform").hide(),$(".maintable").show(),$("#btn-salvar-consultoria").data("id",null),$("#btn-salvar-consultoria").data("act",null),$("#id").val(""),$("#titulo").val(""),$("#descricao").val(""),$("#ativo").bootstrapToggle("off"),$("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})}),$(".btn-del-consultoria").click(function(t){t.preventDefault(),$("#loading").modal({keyboard:!1});var a=$(this).data("id");$.ajax({type:"POST",url:"acts/acts.consultoria.php?act=del&id="+a,success:function(t){try{$("#loading").modal("hide");var a=JSON.parse(t.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));a.succeed?($("#alert-title").html("Consultoria removido com sucesso!"),$("#alert-content").html("A remoção da consultoria foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada."),$("#alert").modal("show"),$("#alert").on("hidden.bs.modal",function(t){window.location.reload()})):($("#alert-title").html(a.title),$("#alert-content").html(a.errno+" - "+a.erro),$("#alert").modal("show"))}catch(t){$("#loading").modal("hide"),$("#alert-title").html("Erro ao fazer parse do JSON!"),$("#alert-content").html(String(t.stack)),$("#alert").modal("show")}}})})}),function(l){"use strict";function n(t){return t.is('[type="checkbox"]')?t.prop("checked"):t.is('[type="radio"]')?!!l('[name="'+t.attr("name")+'"]:checked').length:t.is("select[multiple]")?(t.val()||[]).length:t.val()}function a(o){return this.each(function(){var t=l(this),a=l.extend({},r.DEFAULTS,t.data(),"object"==typeof o&&o),e=t.data("bs.validator");(e||"destroy"!=o)&&(e||t.data("bs.validator",e=new r(this,a)),"string"==typeof o&&e[o]())})}var r=function(t,a){this.options=a,this.validators=l.extend({},r.VALIDATORS,a.custom),this.$element=l(t),this.$btn=l('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",l.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",l.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",l.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var t=l(this),a=t.attr("data-match");l(a).on("input.bs.validator",function(){n(t)&&t.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return n(l(this))&&!l(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};r.VERSION="0.11.9",r.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',r.FOCUS_OFFSET=20,r.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},r.VALIDATORS={native:function(t){var a=t[0];return a.checkValidity?!a.checkValidity()&&!a.validity.valid&&(a.validationMessage||"error!"):void 0},match:function(t){var a=t.attr("data-match");return t.val()!==l(a).val()&&r.DEFAULTS.errors.match},minlength:function(t){var a=t.attr("data-minlength");return t.val().length<a&&r.DEFAULTS.errors.minlength}},r.prototype.update=function(){var t=this;return this.$inputs=this.$element.find(r.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){t.clearErrors(l(this))})),this.toggleSubmit(),this},r.prototype.onInput=function(t){var a=this,e=l(t.target),o="focusout"!==t.type;this.$inputs.is(e)&&this.validateInput(e,o).done(function(){a.toggleSubmit()})},r.prototype.validateInput=function(a,e){var o=(n(a),a.data("bs.validator.errors"));a.is('[type="radio"]')&&(a=this.$element.find('input[name="'+a.attr("name")+'"]'));var r=l.Event("validate.bs.validator",{relatedTarget:a[0]});if(this.$element.trigger(r),!r.isDefaultPrevented()){var i=this;return this.runValidators(a).done(function(t){a.data("bs.validator.errors",t),t.length?e?i.defer(a,i.showErrors):i.showErrors(a):i.clearErrors(a),o&&t.toString()===o.toString()||(r=t.length?l.Event("invalid.bs.validator",{relatedTarget:a[0],detail:t}):l.Event("valid.bs.validator",{relatedTarget:a[0],detail:o}),i.$element.trigger(r)),i.toggleSubmit(),i.$element.trigger(l.Event("validated.bs.validator",{relatedTarget:a[0]}))})}},r.prototype.runValidators=function(o){function r(t){return e=t,o.attr("data-"+e+"-error")||((a=o[0].validity).typeMismatch?o.attr("data-type-error"):a.patternMismatch?o.attr("data-pattern-error"):a.stepMismatch?o.attr("data-step-error"):a.rangeOverflow?o.attr("data-max-error"):a.rangeUnderflow?o.attr("data-min-error"):a.valueMissing?o.attr("data-required-error"):null)||o.attr("data-error");var a,e}var i=[],a=l.Deferred();return o.data("bs.validator.deferred")&&o.data("bs.validator.deferred").reject(),o.data("bs.validator.deferred",a),l.each(this.validators,l.proxy(function(t,a){var e=null;!n(o)&&!o.attr("required")||void 0===o.attr("data-"+t)&&"native"!=t||!(e=a.call(this,o))||(e=r(t)||e,!~i.indexOf(e)&&i.push(e))},this)),!i.length&&n(o)&&o.attr("data-remote")?this.defer(o,function(){var t={};t[o.attr("name")]=n(o),l.get(o.attr("data-remote"),t).fail(function(t,a,e){i.push(r("remote")||e)}).always(function(){a.resolve(i)})}):a.resolve(i),a.promise()},r.prototype.validate=function(){var t=this;return l.when(this.$inputs.map(function(){return t.validateInput(l(this),!1)})).then(function(){t.toggleSubmit(),t.focusError()}),this},r.prototype.focusError=function(){if(this.options.focus){var t=this.$element.find(".has-error :input:first");0!==t.length&&(l("html, body").animate({scrollTop:t.offset().top-r.FOCUS_OFFSET},250),t.focus())}},r.prototype.showErrors=function(t){var a=this.options.html?"html":"text",e=t.data("bs.validator.errors"),o=t.closest(".form-group"),r=o.find(".help-block.with-errors"),i=o.find(".form-control-feedback");e.length&&(e=l("<ul/>").addClass("list-unstyled").append(l.map(e,function(t){return l("<li/>")[a](t)})),void 0===r.data("bs.validator.originalContent")&&r.data("bs.validator.originalContent",r.html()),r.empty().append(e),o.addClass("has-error has-danger"),o.hasClass("has-feedback")&&i.removeClass(this.options.feedback.success)&&i.addClass(this.options.feedback.error)&&o.removeClass("has-success"))},r.prototype.clearErrors=function(t){var a=t.closest(".form-group"),e=a.find(".help-block.with-errors"),o=a.find(".form-control-feedback");e.html(e.data("bs.validator.originalContent")),a.removeClass("has-error has-danger has-success"),a.hasClass("has-feedback")&&o.removeClass(this.options.feedback.error)&&o.removeClass(this.options.feedback.success)&&n(t)&&o.addClass(this.options.feedback.success)&&a.addClass("has-success")},r.prototype.hasErrors=function(){return!!this.$inputs.filter(function(){return!!(l(this).data("bs.validator.errors")||[]).length}).length},r.prototype.isIncomplete=function(){return!!this.$inputs.filter("[required]").filter(function(){var t=n(l(this));return!("string"==typeof t?l.trim(t):t)}).length},r.prototype.onSubmit=function(t){this.validate(),(this.isIncomplete()||this.hasErrors())&&t.preventDefault()},r.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},r.prototype.defer=function(t,a){return a=l.proxy(a,this,t),this.options.delay?(window.clearTimeout(t.data("bs.validator.timeout")),void t.data("bs.validator.timeout",window.setTimeout(a,this.options.delay))):a()},r.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var t=l(this),a=t.data("bs.validator.timeout");window.clearTimeout(a)&&t.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var t=l(this),a=t.data("bs.validator.originalContent");t.removeData("bs.validator.originalContent").html(a)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},r.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var t=l.fn.validator;l.fn.validator=a,l.fn.validator.Constructor=r,l.fn.validator.noConflict=function(){return l.fn.validator=t,this},l(window).on("load",function(){l('form[data-toggle="validator"]').each(function(){var t=l(this);a.call(t,t.data())})})}(jQuery);