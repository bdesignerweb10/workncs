$(function() {

	$('html, body').on('click', function(e) {
		if (e.target == document.documentElement) {
			$("html").removeClass("open-sidebar");
		}
	});

	$(".js-open-sidebar").on("click", function(){
		$("html").addClass("open-sidebar");
	});

// BEGIN LOGOUT (logout.php)
$("#logout").on("click", function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.logout.php",
			success: function(data)
			{
			    try {
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						document.cookie.split(";").forEach(function(c) { document.cookie = c.replace(/^ +/, "").replace(/=.*/, "=;expires=" + new Date().toUTCString() + ";path=/"); });
						window.location.href = "./";
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						if(retorno.errno == "12010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = 'provisoria';
							});
						}
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});
// END BEGIN LOGOUT (logout.php)

// BEGIN LOGIN (login.php)

	$("#form-login").submit(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});
		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {	
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						/*if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}*/
					}
			    } // fecha try
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    }; // fecha catch
			}
		}); // fecha ajax
	}); // Fecha #form-login

	$('#btn-login').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

		$.ajax({
			type: "POST",
			url: "acts/acts.login.php?act=login",
			data: $("#form-login").serialize(),
			success: function(data)
			{
			    try {
			        var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					$('#loading').modal('hide');

					if(retorno.succeed) {
						window.location.href = 'home';
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						/*if(retorno.errno == "21010") {
							$('#alert').on('hidden.bs.modal', function (e) {
								window.location.href = '../provisoria';
							});
						}*/
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
	});

	// END LOGIN (login.php)


	/* Slides */

	$('#btn-add-slide').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-slide').data('id', null);
    	$('#btn-salvar-slide').data('act', 'add');    	

    	$('#nome').val('');
    	$('#link').val(''); 
    	$('#img').val('');     	
    	$('#ativo').bootstrapToggle('off');    		    		
    });

    $('#btn-voltar-slide').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-slide').data('id', null);    		

		/*$('#nome').val('');
    	$('#link').val(''); 
    	$('#slide').val('');     	
    	$('#ativo').bootstrapToggle('off');*/
    });

    $("#form-slides").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-slide').data('id');
    	var act = $('#btn-salvar-slide').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.slides.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.slides.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('nome', $('#nome').val());
		formData.append('link', $('#link').val());
		formData.append('img', $('#img')[0].files[0]);		
		//formData.append('ativo', $('#ativo').val());	
		formData.append("ativo", document.getElementById("ativo").checked?"0":"1");	

		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#nome').val('');
						$('#link').val('');
						$('#img').val('');						
						$('#ativo').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#nome').val('');
						$('#link').val('');
						$('#img').val('');						
						$('#ativo').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
					$('#nome').val('');
					$('#link').val('');
					$('#img').val('');					
					$('#ativo').val('');
			    };
			}
		});
	});

	$('.btn-edit-slides').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.slides.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-slide').data('act', 'edit');
				    	$('#btn-salvar-slide').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#nome').val(retorno.dados.nome);				    	
				    	$('#link').val(retorno.dados.link);
				    	$('#ativo').bootstrapToggle(retorno.dados.ativo == 0 ? 'on' : 'off');					    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-slide').data('id', null);
				    	$('#btn-salvar-slide').data('act', null);				    	

				    	$('#id').val('');
				    	$('#nome').val('');				    	
				    	$('#link').val('');
				    	//$('#ativo').bootstrapToggle('off');				    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-slides').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.slides.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Slide removido com sucesso!");
						$('#alert-content').html("A remoção do slide foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

	/* GERENCIAR CURSOS */
	
	

    $('#btn-add-curso').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-curso').data('id', null);
    	$('#btn-salvar-curso').data('act', 'add');    	

    	$('#id').val('');
    	$('#nome').val('');
    	$('#data_inicio').val(''); 
    	$('#descricao').val(''); 
    	$('#link').val('');  
    	$('#inscricao').bootstrapToggle('off'); 
    	$('#destaque').bootstrapToggle('off');
    	$('#ativo').bootstrapToggle('off');    		    		
    });

	$('#btn-voltar-curso').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-curso').data('id', null);
    	$('#headline-ger-curso').html('');
		$('.headline-form').html('');

		$('#id').val('');
    	$('#nome').val('');
    	$('#data_inicio').val(''); 
    	$('#descricao').val(''); 
    	$('#link').val('');  
    	$('#inscricao').bootstrapToggle('off'); 
    	$('#destaque').bootstrapToggle('off');
    	$('#ativo').bootstrapToggle('off');
    });

	$("#form-curso").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-curso').data('id');
    	var act = $('#btn-salvar-curso').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.curso.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.curso.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('nome', $('#nome').val());
		formData.append('data_inicio', $('#data_inicio').val());
		formData.append('descricao', $('#descricao').val());	
		formData.append('link', $('#link').val());		
		formData.append("inscricao", document.getElementById("inscricao").checked?"0":"1");	
		formData.append("destaque", document.getElementById("destaque").checked?"0":"1");
		formData.append("ativo", document.getElementById("ativo").checked?"0":"1");		
		/*console.log($("#inscricao_aberta").is(":checked"));
		console.log($("#destaque").is(":checked"));
		console.log($("#ativo").is(":checked"));*/
		
		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#nome').val('');
						$('#data_inicio').val('');
						$('#descricao').val('');
						$('#link').val('');
						$('#inscricao').val('');
						$('#destaque').val('');
						$('#ativo').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados de clientes/parceiros registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#nome').val('');
						$('#data_inicio').val('');
						$('#descricao').val('');
						$('#link').val('');
						$('#inscricao').val('');
						$('#destaque').val('');
						$('#ativo').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
					$('#nome').val('');
					$('#data_inicio').val('');
					$('#descricao').val('');
					$('#link').val('');
					$('#inscricao').val('');
					$('#destaque').val('');
					$('#ativo').val('');
			    };
			}
		});
	});

	$('.btn-edit-curso').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.curso.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-curso').data('act', 'edit');
				    	$('#btn-salvar-curso').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#nome').val(retorno.dados.nome);				    	
				    	$('#data_inicio').val(retorno.dados.data_inicio);
				    	$('#descricao').val(retorno.dados.descricao);
				    	$('#link').val(retorno.dados.link);				    	
				    	$('#inscricao').bootstrapToggle(retorno.dados.inscricao == 0 ? 'on' : 'off');	
				    	$('#destaque').bootstrapToggle(retorno.dados.destaque == 0 ? 'on' : 'off');	
				    	$('#ativo').bootstrapToggle(retorno.dados.ativo == 0 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-curso').data('id', null);
				    	$('#btn-salvar-curso').data('act', null);				    	

				    	$('#id').val('');
				    	$('#nome').val('');				    	
				    	$('#data_inicio').val('');
				    	$('#descricao').val('');
				    	$('#link').val('');
				    	$('#inscricao').bootstrapToggle('off');
				    	$('#destaque').bootstrapToggle('off');
				    	$('#ativo').bootstrapToggle('off');	
			    			    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-curso').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.curso.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Curso removido com sucesso!");
						$('#alert-content').html("A remoção do curso foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });



    /* GERENCIAR CURSOS */
	
	

    $('#btn-add-quemsomos').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-quemsomos').data('id', null);
    	$('#btn-salvar-quemsomos').data('act', 'add');    	

    	$('#id').val('');
    	$('#nome').val('');    	 
    	$('#descricao').val('');     	
    	$('#ativo').bootstrapToggle('off');    		    		
    });

	$('#btn-voltar-quemsomos').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-quemsomos').data('id', null);
    	$('#headline-ger-quemsomos').html('');
		$('.headline-form').html('');

		$('#id').val('');
    	$('#nome').val('');    	
    	$('#descricao').val('');
    	$('#ativo').bootstrapToggle('off');
    });

	$("#form-quemsomos").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-quemsomos').data('id');
    	var act = $('#btn-salvar-quemsomos').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.quemsomos.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.quemsomos.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('nome', $('#nome').val());		
		formData.append('descricao', $('#descricao').val());
		formData.append("ativo", document.getElementById("ativo").checked?"0":"1");		
		/*console.log($("#inscricao_aberta").is(":checked"));
		console.log($("#destaque").is(":checked"));
		console.log($("#ativo").is(":checked"));*/
		
		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#nome').val('');						
						$('#descricao').val('');						
						$('#ativo').val('');

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados de quem somos registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#nome').val('');				
						$('#descricao').val('');						
						$('#ativo').val('');
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
					$('#nome').val('');					
					$('#descricao').val('');					
					$('#ativo').val('');
			    };
			}
		});
	});

	$('.btn-edit-quemsomos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.quemsomos.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-quemsomos').data('act', 'edit');
				    	$('#btn-salvar-quemsomos').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#nome').val(retorno.dados.nome);
				    	$('#descricao').val(retorno.dados.descricao);
				    	$('#ativo').bootstrapToggle(retorno.dados.ativo == 0 ? 'on' : 'off');				    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-quemsomos').data('id', null);
				    	$('#btn-salvar-quemsomos').data('act', null);				    	

				    	$('#id').val('');
				    	$('#nome').val('');
				    	$('#descricao').val('');				    	
				    	$('#ativo').bootstrapToggle('off');	
			    			    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-quemsomos').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.quemsomos.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Quem somos removido com sucesso!");
						$('#alert-content').html("A remoção do quem somos foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });


    /* GERENCIAR CONSULTORIA */

    $('#btn-add-consultoria').click(function(e) {
		e.preventDefault();

		$('.maintable').hide();
		$('.mainform').show();

		$('#btn-salvar-consultoria').data('id', null);
    	$('#btn-salvar-consultoria').data('act', 'add');    	

    	$('#id').val('');
    	$('#titulo').val('');
    	$('#descricao').val(''); 
    	$('#ativo').bootstrapToggle('off');
    	   		    		
    });

    $('#btn-voltar-consultoria').click(function(e) {
		e.preventDefault();

		$('.mainform').hide();
		$('.maintable').show();

    	$('#btn-salvar-consultoria').data('id', null);
    	$('#headline-ger-consultoria').html('');
		$('.headline-form').html('');

		$('#id').val('');
    	$('#titulo').val('');
    	$('#descricao').val(''); 
    	$('#ativo').bootstrapToggle('off');
    });

    $("#form-consultoria").submit(function(e) {
		e.preventDefault();

		$('#loading-modal').modal({
			keyboard: false
		});

		var id = $('#btn-salvar-consultoria').data('id');
    	var act = $('#btn-salvar-consultoria').data('act');

    	if(act == "edit") {
    		var url = "acts/acts.consultoria.php?act=" + act + "&id=" + id;
    	}
    	else {
    		var url = "acts/acts.consultoria.php?act=" + act;    		
    	}

		var formData = new FormData();
		formData.append('id', $('#id').val());
		formData.append('titulo', $('#titulo').val());
		formData.append('descricao', $('#descricao').val());
		//formData.append('img', $('#img')[0].files[0]);			
		formData.append("ativo", document.getElementById("ativo").checked?"0":"1");	
		
		$.ajax({
			type: "POST",
			url: url,
			data : formData,
			processData: false,
			contentType: false,
			success: function(data)
			{
			    try {
			    	console.log(data);
					$('#loading-modal').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#id').val('');
						$('#titulo').val('');
						$('#descricao').val('');
						//$('#img').val('');
						$('#ativo').val('');						

						$('#alert-title').html("Dados alterados com sucesso!");
						$('#alert-content').html("Dados da consultoria registrados com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');

						$('#id').val('');
						$('#titulo').val('');
						$('#descricao').val('');
						//$('#img').val('');
						$('#ativo').val('');						
					}
			    }
			    catch (e) {
					$('#loading-modal').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');

					$('#id').val('');
					$('#titulo').val('');
					$('#descricao').val('');
					//$('#img').val('');
					$('#ativo').val('');
			    };
			}
		});
	});

	$('.btn-edit-consultoria').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.consultoria.php?act=showupd&id=" + id,
			success: function(data)		
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('.maintable').hide();
						$('.mainform').show();

				    	$('#btn-salvar-consultoria').data('act', 'edit');
				    	$('#btn-salvar-consultoria').data('id', id);	    				

						//var d = new Date(retorno.dados.data * 1000);

				    	$('#id').val(retorno.dados.id);
				    	$('#titulo').val(retorno.dados.titulo);				    	
				    	$('#descricao').val(retorno.dados.descricao);				    	
				    	$('#ativo').bootstrapToggle(retorno.dados.ativo == 0 ? 'on' : 'off');			    	
					}
					else {
						$('.mainform').hide();
						$('.maintable').show();

				    	$('#btn-salvar-consultoria').data('id', null);
				    	$('#btn-salvar-consultoria').data('act', null);				    	

				    	$('#id').val('');
				    	$('#titulo').val('');				    	
				    	$('#descricao').val('');
				    	$('#ativo').bootstrapToggle('off');				    				    			    	

						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {			    	
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });

    $('.btn-del-consultoria').click(function(e) {
		e.preventDefault();

		$('#loading').modal({
			keyboard: false
		});

    	var id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "acts/acts.consultoria.php?act=del&id=" + id,
			success: function(data)
			{
				try {
					$('#loading').modal('hide');

					var retorno = JSON.parse(data.replace(/(\r\n|\n|\r)/gm," ").replace(/\s+/g," "));

					if(retorno.succeed) {
						$('#alert-title').html("Consultoria removido com sucesso!");
						$('#alert-content').html("A remoção da consultoria foi efetuada com sucesso! Ao fechar esta mensagem a página será recarregada.");
						$('#alert').modal('show');

						$('#alert').on('hidden.bs.modal', function (e) {
							window.location.reload();
						});
					}
					else {
						$('#alert-title').html(retorno.title);
						$('#alert-content').html(retorno.errno + " - " + retorno.erro);
						$('#alert').modal('show');
					}
			    }
			    catch (e) {
					$('#loading').modal('hide');
					$('#alert-title').html("Erro ao fazer parse do JSON!");
					$('#alert-content').html(String(e.stack));
					$('#alert').modal('show');
			    };
			}
		});
    });
});

/*!
 * Validator v0.11.9 for Bootstrap 3, by @1000hz
 * Copyright 2017 Cina Saffary
 * Licensed under http://opensource.org/licenses/MIT
 *
 * https://github.com/1000hz/bootstrap-validator
 */

+function(a){"use strict";function b(b){return b.is('[type="checkbox"]')?b.prop("checked"):b.is('[type="radio"]')?!!a('[name="'+b.attr("name")+'"]:checked').length:b.is("select[multiple]")?(b.val()||[]).length:b.val()}function c(b){return this.each(function(){var c=a(this),e=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b),f=c.data("bs.validator");(f||"destroy"!=b)&&(f||c.data("bs.validator",f=new d(this,e)),"string"==typeof b&&f[b]())})}var d=function(c,e){this.options=e,this.validators=a.extend({},d.VALIDATORS,e.custom),this.$element=a(c),this.$btn=a('button[type="submit"], input[type="submit"]').filter('[form="'+this.$element.attr("id")+'"]').add(this.$element.find('input[type="submit"], button[type="submit"]')),this.update(),this.$element.on("input.bs.validator change.bs.validator focusout.bs.validator",a.proxy(this.onInput,this)),this.$element.on("submit.bs.validator",a.proxy(this.onSubmit,this)),this.$element.on("reset.bs.validator",a.proxy(this.reset,this)),this.$element.find("[data-match]").each(function(){var c=a(this),d=c.attr("data-match");a(d).on("input.bs.validator",function(){b(c)&&c.trigger("input.bs.validator")})}),this.$inputs.filter(function(){return b(a(this))&&!a(this).closest(".has-error").length}).trigger("focusout"),this.$element.attr("novalidate",!0)};d.VERSION="0.11.9",d.INPUT_SELECTOR=':input:not([type="hidden"], [type="submit"], [type="reset"], button)',d.FOCUS_OFFSET=20,d.DEFAULTS={delay:500,html:!1,disable:!0,focus:!0,custom:{},errors:{match:"Does not match",minlength:"Not long enough"},feedback:{success:"glyphicon-ok",error:"glyphicon-remove"}},d.VALIDATORS={"native":function(a){var b=a[0];return b.checkValidity?!b.checkValidity()&&!b.validity.valid&&(b.validationMessage||"error!"):void 0},match:function(b){var c=b.attr("data-match");return b.val()!==a(c).val()&&d.DEFAULTS.errors.match},minlength:function(a){var b=a.attr("data-minlength");return a.val().length<b&&d.DEFAULTS.errors.minlength}},d.prototype.update=function(){var b=this;return this.$inputs=this.$element.find(d.INPUT_SELECTOR).add(this.$element.find('[data-validate="true"]')).not(this.$element.find('[data-validate="false"]').each(function(){b.clearErrors(a(this))})),this.toggleSubmit(),this},d.prototype.onInput=function(b){var c=this,d=a(b.target),e="focusout"!==b.type;this.$inputs.is(d)&&this.validateInput(d,e).done(function(){c.toggleSubmit()})},d.prototype.validateInput=function(c,d){var e=(b(c),c.data("bs.validator.errors"));c.is('[type="radio"]')&&(c=this.$element.find('input[name="'+c.attr("name")+'"]'));var f=a.Event("validate.bs.validator",{relatedTarget:c[0]});if(this.$element.trigger(f),!f.isDefaultPrevented()){var g=this;return this.runValidators(c).done(function(b){c.data("bs.validator.errors",b),b.length?d?g.defer(c,g.showErrors):g.showErrors(c):g.clearErrors(c),e&&b.toString()===e.toString()||(f=b.length?a.Event("invalid.bs.validator",{relatedTarget:c[0],detail:b}):a.Event("valid.bs.validator",{relatedTarget:c[0],detail:e}),g.$element.trigger(f)),g.toggleSubmit(),g.$element.trigger(a.Event("validated.bs.validator",{relatedTarget:c[0]}))})}},d.prototype.runValidators=function(c){function d(a){return c.attr("data-"+a+"-error")}function e(){var a=c[0].validity;return a.typeMismatch?c.attr("data-type-error"):a.patternMismatch?c.attr("data-pattern-error"):a.stepMismatch?c.attr("data-step-error"):a.rangeOverflow?c.attr("data-max-error"):a.rangeUnderflow?c.attr("data-min-error"):a.valueMissing?c.attr("data-required-error"):null}function f(){return c.attr("data-error")}function g(a){return d(a)||e()||f()}var h=[],i=a.Deferred();return c.data("bs.validator.deferred")&&c.data("bs.validator.deferred").reject(),c.data("bs.validator.deferred",i),a.each(this.validators,a.proxy(function(a,d){var e=null;!b(c)&&!c.attr("required")||void 0===c.attr("data-"+a)&&"native"!=a||!(e=d.call(this,c))||(e=g(a)||e,!~h.indexOf(e)&&h.push(e))},this)),!h.length&&b(c)&&c.attr("data-remote")?this.defer(c,function(){var d={};d[c.attr("name")]=b(c),a.get(c.attr("data-remote"),d).fail(function(a,b,c){h.push(g("remote")||c)}).always(function(){i.resolve(h)})}):i.resolve(h),i.promise()},d.prototype.validate=function(){var b=this;return a.when(this.$inputs.map(function(){return b.validateInput(a(this),!1)})).then(function(){b.toggleSubmit(),b.focusError()}),this},d.prototype.focusError=function(){if(this.options.focus){var b=this.$element.find(".has-error :input:first");0!==b.length&&(a("html, body").animate({scrollTop:b.offset().top-d.FOCUS_OFFSET},250),b.focus())}},d.prototype.showErrors=function(b){var c=this.options.html?"html":"text",d=b.data("bs.validator.errors"),e=b.closest(".form-group"),f=e.find(".help-block.with-errors"),g=e.find(".form-control-feedback");d.length&&(d=a("<ul/>").addClass("list-unstyled").append(a.map(d,function(b){return a("<li/>")[c](b)})),void 0===f.data("bs.validator.originalContent")&&f.data("bs.validator.originalContent",f.html()),f.empty().append(d),e.addClass("has-error has-danger"),e.hasClass("has-feedback")&&g.removeClass(this.options.feedback.success)&&g.addClass(this.options.feedback.error)&&e.removeClass("has-success"))},d.prototype.clearErrors=function(a){var c=a.closest(".form-group"),d=c.find(".help-block.with-errors"),e=c.find(".form-control-feedback");d.html(d.data("bs.validator.originalContent")),c.removeClass("has-error has-danger has-success"),c.hasClass("has-feedback")&&e.removeClass(this.options.feedback.error)&&e.removeClass(this.options.feedback.success)&&b(a)&&e.addClass(this.options.feedback.success)&&c.addClass("has-success")},d.prototype.hasErrors=function(){function b(){return!!(a(this).data("bs.validator.errors")||[]).length}return!!this.$inputs.filter(b).length},d.prototype.isIncomplete=function(){function c(){var c=b(a(this));return!("string"==typeof c?a.trim(c):c)}return!!this.$inputs.filter("[required]").filter(c).length},d.prototype.onSubmit=function(a){this.validate(),(this.isIncomplete()||this.hasErrors())&&a.preventDefault()},d.prototype.toggleSubmit=function(){this.options.disable&&this.$btn.toggleClass("disabled",this.isIncomplete()||this.hasErrors())},d.prototype.defer=function(b,c){return c=a.proxy(c,this,b),this.options.delay?(window.clearTimeout(b.data("bs.validator.timeout")),void b.data("bs.validator.timeout",window.setTimeout(c,this.options.delay))):c()},d.prototype.reset=function(){return this.$element.find(".form-control-feedback").removeClass(this.options.feedback.error).removeClass(this.options.feedback.success),this.$inputs.removeData(["bs.validator.errors","bs.validator.deferred"]).each(function(){var b=a(this),c=b.data("bs.validator.timeout");window.clearTimeout(c)&&b.removeData("bs.validator.timeout")}),this.$element.find(".help-block.with-errors").each(function(){var b=a(this),c=b.data("bs.validator.originalContent");b.removeData("bs.validator.originalContent").html(c)}),this.$btn.removeClass("disabled"),this.$element.find(".has-error, .has-danger, .has-success").removeClass("has-error has-danger has-success"),this},d.prototype.destroy=function(){return this.reset(),this.$element.removeAttr("novalidate").removeData("bs.validator").off(".bs.validator"),this.$inputs.off(".bs.validator"),this.options=null,this.validators=null,this.$element=null,this.$btn=null,this.$inputs=null,this};var e=a.fn.validator;a.fn.validator=c,a.fn.validator.Constructor=d,a.fn.validator.noConflict=function(){return a.fn.validator=e,this},a(window).on("load",function(){a('form[data-toggle="validator"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery);		
