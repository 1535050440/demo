var util = require('./utils.js');
var app = getApp();
var doubanUrl = app.globalData.doubanBase;
Page({
  //RESTFUL API JSON
  data: {
    inTheater: {},
    comingSoon: {},
    top250: {}
  },
  onLoad: function(event) {
    var inTheaterUrl = doubanUrl + "/v2/movie/in_theaters" + "?start=0&count=3";
    var comingSoonUrl = doubanUrl + "/v2/movie/coming_soon" + "?start=0&count=3";
    var top250Url = doubanUrl + "/v2/movie/top250" + "?start=0&count=3";
    this.getMovieListData(inTheaterUrl, 'inTheater','正在热映');
    this.getMovieListData(comingSoonUrl, 'comingSoon','即将上映');
    this.getMovieListData(top250Url, 'top250','豆瓣250');
  },
  onMovieTap:function(event){
    wx.navigateTo({
      url: "../home/pic/pic"
    })
 
  },
  // 访问豆瓣api的公共方法
  getMovieListData: function(url, key,categoryTitle) {
    var that = this;
    wx.request({
      url: url,
      data: {},
      header: {
        "Content-Type": "application/xml"
      },
      method: 'GET',
      success: function(res) {
        // console.log(res.data);
        that.processDoubanData(res.data, key, categoryTitle);
      },
      fail: function(res) {
        console.log(22);
      }
    })
  },
  processDoubanData: function (moviesDouban, settedkey, categoryTitle) {
    console.log(moviesDouban);
    var movies = [];
    for (var idx in moviesDouban.subjects) {
      var subjects = moviesDouban.subjects[idx]
      var title = subjects.title;
      if (title.length > 6) {
        title = title.substring(0, 6) + "...";
      }
      var temp = {
        title: title,
        average: subjects.rating.average,
        coverageUrl: subjects.images.large,
        stars: util.convertToStarsArray(subjects.rating.average)
      }
      movies.push(temp)
    }
    var readyData = {};
    readyData[settedkey] = {
      categoryTitle: categoryTitle,
      movies: movies
    }
    this.setData(readyData)
  }

  ,


  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    console.log('用户点击分享')
  }
})