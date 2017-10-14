/**
 * Updated by cmpoon
 * Created by andrewhill on 17/07/2016.
 */

// Redirect http to https
if (window.location.protocol === 'http:') { 
	window.location.href = 'https:' + window.location.href.slice(5); 
}