UrlManager = {
    getGETParam: function(paramname){
        var paramsparts = window.location.search.substr(1).split('&'), kpart;
        if (paramsparts.length > 0){
            for(var i in paramsparts){
                kpart = paramsparts[i].split("=");
                if (kpart[0] == paramname){
                    kpart[1] = decodeURI(kpart[1]);
                    return kpart[1];
                }
            }
            return "";
        }
        return "";
    },
    getAllParams: function(){
        var hashUrl = window.location.hash, newdatesarr=[];
        var prm = hashUrl.split("&");
        var partprm, returnParams={}, indexone, val;
        for (var im in prm){
            partprm = prm[im].split("=");
            indexone = partprm[0];
            indexone = indexone.replace("#", "");
            val = partprm[1];
            returnParams[indexone] = decodeURIComponent(val);
        }
        return returnParams;
    },
    getHashUrlParam: function(paramname){
        var hashUrl = window.location.hash, newdatesarr=[];
        if (hashUrl != ""){
            var prm = hashUrl.split("&");
            prm[0] = prm[0].substr(1);
            var partprm, moduleIdPrm, stateIdPrm, hashPrm;
            for (var im in prm){
                partprm = prm[im].split("=");
                if(partprm[0] == paramname){
                    return partprm[1];
                }
            }
            return "";
        }else{
            return "";
        }
    },
    updateHashUrlParam: function(paramname, paramvalue){
        var hashUrl = window.location.hash;
        if (hashUrl != ""){
            var prm = hashUrl.split("&"), partprm, hashArr = [], iArr=0;
            prm[0] = prm[0].substr(1);
            for (var im in prm){
                partprm = prm[im].split("=");
                if (partprm[0] != paramname){
                    hashArr[iArr] = prm[im];
                    iArr++;
                }
            }
            hashArr[iArr] = paramname+"="+paramvalue;
            window.location.hash = hashArr.join("&");
        }else{
            window.location.hash = paramname+"="+paramvalue;
        }
    },
    deleteHashExept: function(paramsNames){
        if (!paramsNames) paramsNames = [];
        var hashUrl = window.location.hash;
        if (hashUrl != ""){
            var prm = hashUrl.split("&"), partprm, hashArr = [], iArr=0;
            prm[0] = prm[0].substr(1);
            for (var im in prm){
                partprm = prm[im].split("=");
                if (in_array(partprm[0], paramsNames)){
                    hashArr[iArr] = prm[im];
                    iArr++;
                }
            }
            window.location.hash = hashArr.join("&");
        }
    },
    deleteHashSelected: function(paramsNames){
        if (!paramsNames) paramsNames = [];
        var hashUrl = window.location.hash;
        if (hashUrl != ""){
            var prm = hashUrl.split("&"), partprm, hashArr = [], iArr=0;
            prm[0] = prm[0].substr(1);
            for (var im in prm){
                partprm = prm[im].split("=");
                if (!in_array(partprm[0], paramsNames)){
                    hashArr[iArr] = prm[im];
                    iArr++;
                }
            }
            window.location.hash = hashArr.join("&");
        }
    }
}