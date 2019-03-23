// pages/posts/post-detail/post-detail.js
var postData = require('../../../data/post-data.js')
var app = getApp();
Page({
  data:{
    isPlayingMusic: false
  },
  onLoad: function(option) {
    var postId = option.id;
    this.data.currentPostId = postId;
    var posts = postData.postList[postId]
    // console.log(posts)
    this.setData({
      postData: posts
    });
    // wx.setStorageSync('key', "这是缓存")
    //   wx.setStorageSync('key', {
    //     game: "呵呵呵呵呵呵呵呵呵呵",
    //     dev: "呵呵呵呵呵呵呵呵呵呵"
    //   })

    // },

    // onCollectionTap:function(event){
    //   var game = wx.getStorageSync('key')
    //   console.log(game)
    // },

    // onShareTap:function(event){
    //   wx.removeStorageSync('key')
    //   //清除所有缓存
    //   wx.clearStorageSync()
    // },
    // var postsCollected = {
    // 1:"true",
    // 2:"false",
    // 3:"true"
    // }
    var aa = wx.getStorageSync('posts_collected')
    console.log(111111111111111111);
    console.log(aa);
    console.log(222222222222222222);
    if (aa) {
      var postsCollected = aa[postId];
      this.setData({
        collected: postsCollected
      })
    } else {
      var postsCollected = {};
      postsCollected[postId] = false;
      wx.setStorageSync('posts_collected', postsCollected);
    }
    console.log(aa)
  },

  onCollectionTap: function(event) {
    var postId = this.data.currentPostId;
    console.log(postId);
    //  获取缓存的对象
    var postsCollected = wx.getStorageSync('posts_collected');
    var postCollected = postsCollected[postId];

    postCollected = !postCollected;
    postsCollected[postId] = postCollected;

    this.showToast(postsCollected, postCollected);


  },
  showToast: function (postsCollected, postCollected) {
    var that = this;
    wx.showToast({
      title: postCollected ? '收藏成功' : '取消成功',
      icon: 'success',
      duration: 1500,
      success: function() {
        console.log('success')
        that.setData({
          collected: postCollected
        })
        wx.setStorageSync('posts_collected', postsCollected)
      }
    })
  },
  //  自定义函数
  showModal: function(postsCollected, postCollected) {
    var that = this;
    wx.showModal({
      title: postCollected ? '收藏该文章' : '是否取消收藏',
      content: '内容',
      cancelColor: 'red',
      showCancel: postCollected ? false : true,
      success(res) {
        if (res.confirm) {
          console.log('用户点击确定')
          that.setData({
            collected: postCollected
          })
          wx.setStorageSync('posts_collected', postsCollected)
        } else if (res.cancel) {
          console.log('用户点击取消')
        }
        
      }
    })
  },
  onShareTap:function(event)
  {
    console.log(event);
    console.log('***********');
    var itemList = [
      '分享到微信好友',
      '分享到朋友圈',
      '分享到微博',
      '分享到支付宝',
      '分享到支付宝朋友圈'
    ]
    wx.showActionSheet({
      itemList: itemList,
      itemColor:"#405f80",
      success:function(res)
      {
        console.log(res);
        wx.showModal({
          title: '【' + itemList[res.tapIndex] + '】',
          content: '小程序暂未开放',
        })
      }
    })
    console.log(11);
  },


  onBaiduTop: function() {
    wx.navigateTo({
      url: "../../baiduapi/baiduapi"
    })
  },
  //  点击音乐
  onMusicTap:function(event)
  {
    var that = this;
    var isPlayingMusic = this.data.isPlayingMusic;
    console.log(isPlayingMusic);
    if (isPlayingMusic) {
      wx.pauseBackgroundAudio();
      that.setData({
        isPlayingMusic: false
      })
      that.isPlayingMusic = false;
    } else {
      var musicData = postData.postList[this.data.currentPostId].music;
      wx.playBackgroundAudio({
        dataUrl: musicData.url,
        title: musicData.title,
        coverImgUrl: musicData.coverImg
        // dataUrl: 'https://myphp.vip/music/zuimeideqidai.mp3',
        // title: '最美的期待'
      })
      that.setData({
        isPlayingMusic:true
      })
    }
      
    
  }
})