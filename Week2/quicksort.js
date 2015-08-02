var test = [3, 8, 2, 5, 1, 4, 7, 6];
quicksort(test);


function quicksort(arr, l, r) {
	l = l || 0;
	r = r || arr.length - 1;

	var length = r - l + 1;
	// var p = Math.floor(Math.random() * length);
	// var pivot = arr[p];

	var p = partition(arr, l, r);

	var less = quicksort(arr, l, p - 1));
	var more = quicksort(arr, p + 1, r);

	return less.concat(pivot, more);
}

function partition(arr, l, r) {
	var p = arr[l];
	var i = l + 1;
	for (var j = l + 1; j < r; j++) {
		if (arr[j] < p) {
			swap(arr, i, j);
			i++;
		}
	}
	swap(arr, l, i - 1);

	return p;
}

function swap(arr, m, n) {
	var temp = arr[m];
	arr[m] = arr[n]
	arr[n] = temp;	
}