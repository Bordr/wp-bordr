var arrayToTable = (function() {
			function titleClick(e) {
				e.preventDefault();
				var column = this.innerHTML;
				var tableId = parentNode(this, 4).id;
				if(conf[tableId].sortColumn == column) {
					conf[tableId].order = !conf[tableId].order;
				} else {
					conf[tableId].sortColumn = column;
					conf[tableId].order = true;
				}
				sortAgain(tableId);
				setTable(tableId, conf[tableId].json);
			}
			
			function removeClick(e) {
				e.preventDefault();
				var column = this.parentNode.firstChild.innerHTML;
				var tableId = parentNode(this, 4).id;
				for(var i=0; i<conf[tableId].columns.length; i++) {
					if(conf[tableId].columns[i] == column) {
						var hidden = conf[tableId].columns.splice(i, 1);
						conf[tableId].hidden.push(hidden[0]);
					}
				}
				setTable(tableId, conf[tableId].json);
			}
			
			function parentNode(node, nb) {
				for(var i=0; i<nb; i++) {
					node = node.parentNode;
				}
				return node
			}
			
			function filterFloat(value) {
				if(/^\-?([0-9]+(\.[0-9]+)?|Infinity)$/.test(value))
					return Number(value);
				return NaN;
			}
			
			function sortAgain(tableId) {
				var column = conf[tableId].sortColumn;
				conf[tableId].json = conf[tableId].json.sort(function(a, b) {
					var a = a[column] || 'undefined';
					var b = b[column] || 'undefined';
					var aNumber = filterFloat(a);
					var bNumber = filterFloat(b);
					var isANaN = isNaN(aNumber);
					if(isANaN != isNaN(bNumber)) {
						if(isANaN) {
							return conf[tableId].order ? 1 : -1;
						} else {
							return conf[tableId].order ? -1 : 1;
						}
					} else if(isANaN) {
						if(a && a.toString() == '[object Object]') {
							a = JSON.stringify(a);
						}
						if(b && b.toString() == '[object Object]') {
							b = JSON.stringify(b);
						}
						var ret = conf[tableId].order ? (a < b ? -1 : (a > b ? 1 : 0)) : (a < b ? 1 : (a > b ? -1 : 0))
						return ret;
					} else {
						return conf[tableId].order ? aNumber-bNumber : bNumber-aNumber;
					}
				});
			}
			
			function setContent(tableId) {
				// console.log(conf[tableId]);
				var table = conf[tableId].table;
				var columns = conf[tableId].columns;
				
				table.innerHTML = '';
				
				//Header
				var head = document.createElement('thead');
				table.appendChild(head);
				var tr = document.createElement('tr');
				head.appendChild(tr);
				for(var i=0; i<columns.length; i++) {
					var td = document.createElement('td');
					tr.appendChild(td);
					var title = document.createElement('a');
					title.href = '#';
					title.textContent = columns[i];
					td.appendChild(title);
					title.addEventListener('click', titleClick);
					var remove = document.createElement('a');
					remove.href = '#';
					remove.textContent = 'X';
					remove.setAttribute('class', 'remove')
					remove.addEventListener('click', removeClick);
// 					td.appendChild(remove);
				}
				
				//Body
				var body = document.createElement('tbody');
				table.appendChild(body);
				for(var i=0; i<conf[tableId].json.length; i++) {
					var current = conf[tableId].json[i];
					var tr = document.createElement('tr');
					body.appendChild(tr);
					for(var j=0; j<columns.length; j++) {
						var td = document.createElement('td');
						var txt = current[columns[j]];
						if(txt && txt.toString() == '[object Object]') {
							txt = JSON.stringify(txt).replace(/\n/g, '').replace(/,/g, ',\n');
						}
						td.textContent = txt.replace('&raquo;', '\u00bb');

// 						var link = document.createElement('a');
// 						link.href = '#';
// 						link.textContent = columns[i];
// 						td.appendChild(link);

						tr.appendChild(td);
					}
				}
			}

			var conf = {};
			
			var setTable = function(tableId, json) {
				if(!(json instanceof Array)) {
// 					console.log('Error: Json object is not an array');
					return;
				}
				if(json.length < 1) {
// 					console.log('Error: Json array is empty');
					return;
				}
// 				console.log('set Table', json[0].id);
				if(!conf[tableId]) {
// 					console.log('new table');
					var columns = Object.keys(json[0]);
					table = document.getElementById(tableId);
					conf[tableId] = {sortColumn:null, order:true, json:json, table:table, columns:columns, hidden:[]};
				} else {
					conf[tableId].json = json;
				}
				setContent(tableId);
			};
			
			var resetTable = function(tableId) {
				document.getElementById(tableId).innerHTML = '';
				sorter[tableId] = null;
			}
			
			return {
				setTable:setTable,
				resetTable:resetTable
			};
		})();