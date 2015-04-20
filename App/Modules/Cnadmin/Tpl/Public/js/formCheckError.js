// JavaScript Document
//表单错误验证输出提示信息
$(function(){
	$("#form1").validationEngine({
	    "custom_error_messages" : {
		    "#title"       : {
			    "required" : {
				    "message" : "请填写标题！"
				}
			},
			"#img"         : {
			    "required" : {
				    "message" : "请选择一张图片！"
				}
			},
			"#hits"   :          {
			    "required" :       {
				    "message" : "请填写一个数字，或0！"
				}
			},
			"#listorder"   :          {
			    "required" :       {
				    "message" : "请填写一个数字做为排序，或0！"
				}
			},
			"#name"   :       {
			    "required" :       {
				    "message" : "请填写网站名称！"
				}
			},
			"#url"   :       {
			    "required" :       {
				    "message" : "请填写URL地址！"
				},
			    "custom[url]" : {
				   "message" : "请填写正确的网站地址！如：http://www.baidu.com"
				}
			},
			"#urlname":       {
			    "required" :       {
				    "message" : "请填写一个栏目名称翻译成的英文简词语，URL优化！"
				}
			},
			/**********菜单管理**********/
			"#CnName":       {
			    "required" :       {
				    "message" : "请填写菜单名称！"
				}
			},
			"#EnName":       {
			    "required" :       {
				    "message" : "请填写菜单英文名称！"
				}
			},
			// 招聘-人数
			"#number":       {
			    "required" :       {
				    "message" : "请填写招聘人数！"
				}
			},
			// 内链优化
			"#keyword":       {
			    "required" :       {
				    "message" : "请填写关键字！"
				}
			},
			// 权限组-名称
			"#role_name":       {
			    "required" :       {
				    "message" : "请填写权限组名称！"
				}
			},		
			/***********管理员管理*********/ 
			"#account" : {
				"required" : {
				  "message" : "请填写用户名！"
				}
			},
			"#Upassword" : {
				"required" : {
				  "message" : "请填写密码！"
				}
			},
			"#nickname" : {
				"required" : {
				  "message" : "请填写您的姓名！"
				}
			},
			/**********扩展**********/
			"#setname" : {
			    "required" :       {
				    "message" : "请填写功能名称！"
				}
			},
			"#settag" : {
			    "required" :       {
				    "message" : "请填写功能标签，必须为英文字母！"
				}
			},
			"#setvalue"   :       {
			    "required" :       {
				    "message" : "请填写功能设置！"
				}
			},
			/**********站点设置**********/
			"#SITE_URL"   :       {
			    "required" :       {
				    "message" : "请填写网站网址！"
				}
			},
			"#SITE_TITLE"   :       {
			    "required" :       {
				    "message" : "请填写网站标题！"
				}
			},
			"#SITE_AUTHOR"   :       {
			    "required" :       {
				    "message" : "请填写网站作者！"
				}
			},
			"#logo"   :       {
			    "required" :       {
				    "message" : "请选择上传logo图片！"
				}
			},
			"#icon"   :       {
			    "required" :       {
				    "message" : "请选择上传icon图标！"
				}
			},
			"#errorcount"   :       {
			    "required" :       {
				    "message" : "请填写后台失败登录次数！"
				}
			},
			"#errorinterval"   :       {
			    "required" :       {
				    "message" : "请填写后台登录超过次数后再次登录间隔时间！"
				}
			},			
			"#messageinterval"   :       {
			    "required" :       {
				    "message" : "请填写留言间隔时间！"
				}
			},
		    "#mail_server" : {
				"required" : {
				  "message" : "请填写一个Email服务器，如：QQ邮箱/smtp.qq.com,126邮箱/smtp.126.com！"
				}
			},
		    "#mail_usermail" : {
				"required" : {
				  "message" : "请填写一个Email用户邮箱，如：QQ邮箱/123456@qq.com,126邮箱/china@126.com！"
				}
			},
		    "#mail_user" : {
				"required" : {
				  "message" : "请填写一个Email用户名，只需填写@号前面的名称,如：QQ邮箱123456@qq.com,只需填123456即可！！"
				}
			},
		    "#mail_password" : {
				"required" : {
				  "message" : "请填写Email密码！"
				}
			},
            /***********修改密码*********/ 
			"#oldpassword" : {
				"required" : {
				  "message" : "请填写您的旧密码！"
				}
			},
			"#password" : {
				"required" : {
				  "message" : "请填写您的新密码！"
				}
			},
			"#repassword" : {
				"required" : {
				  "message" : "请确认您的新密码！"
				}
			},
			"#verify" : {
				"required" : {
				  "message" : "请填写验证码！"
				}
			},
			"#urlname":       {
			    "required" :       {
				    "message" : "请填写一个栏目名称翻译成的英文简词语，URL优化！"
				}
			},
            /***********留言板*********/ 
			"#reply_title" : {
				"required" : {
				  "message" : "请填写回复标题！"
				}
			}
		}
	});
});