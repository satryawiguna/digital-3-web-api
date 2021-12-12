'use strict';

app.service('Session', function() {
	this.create = function(data) {
		this.userId = data.dto.user_id;
		this.email = data.dto.email;
		this.roleId = data.dto.role_id;
		this.role = data.dto.role;
		this.token = data.dto.token;
		this.name = (data.dto.name) ? data.dto.name : null;
		this.avatar = (data.dto.avatar) ? data.dto.avatar : null;
	};

	this.destroy = function() {
		this.userId = null;
		this.email = null;
		this.roleId = null;
		this.role = null;
		this.token = null;
		this.name = null;
		this.avatar = null;
	};
	
	return this;
});