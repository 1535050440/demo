const app = getApp().globalData;
const url = getApp().globalData.url;
var postsData = require('../../data/post-data.js')

Page({

  /**
   * 页面的初始数据
   */
  data: {
    video:"http://myphp.vip/wumai/wumai.mp4",
  
    muke:{
      image1: "https://api.myphp.vip/static/images/banner/muke100111.png",
      image2: "https://api.myphp.vip/static/images/banner/muke10022.png",
      image3: "https://api.myphp.vip/static/images/banner/muke10033.png",
    }
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function (options) {

    // this.data.postList = postsData.postList
    this.setData({
      postList: postsData.postList
    }),
    console.log('onLoad')
  },

  onPostTap:function(event)
  {
    var postId = event.currentTarget.dataset.postId;
    var postName = event.currentTarget.dataset.postName;
    // console.log(postName);
    // console.log(postId);
    wx.navigateTo({
      url: "../posts/post-detail/post-detail?id=" + postId + "&title" + postName
    })
  },
  onBannerTap:function(event)
  {
    var postId = event.target.dataset.postid;
    wx.navigateTo({
      url: "post-detail/post-detail?id=" + postId
    })
  }
  ,


  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function () {
    console.log('用户点击分享')
  }
})