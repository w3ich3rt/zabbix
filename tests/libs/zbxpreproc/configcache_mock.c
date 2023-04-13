/*
** Zabbix
** Copyright (C) 2001-2023 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/

#include "zbxcommon.h"
#include "zbxcacheconfig.h"

int	__wrap_zbx_dc_expand_user_macros_from_cache(zbx_um_cache_t *um_cache, char **text, const zbx_uint64_t *hostids,
		int hostids_num, char **error)
{
	ZBX_UNUSED(um_cache);
	ZBX_UNUSED(text);
	ZBX_UNUSED(hostids);
	ZBX_UNUSED(hostids_num);
	ZBX_UNUSED(error);

	return SUCCEED;
}
