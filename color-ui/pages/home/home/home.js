const app = getApp().globalData;
const url = getApp().globalData.url;
Page({

  /**
   * 页面的初始数据
   */
  data: {
    userinfo: app.userInfo,
    name: 'null'
  },

  /**
   * 生命周期函数--监听页面加载
   */
  onLoad: function(options) {
    let that = this;

    wx.login({
      success(res) {
        if (res.code) {
          // 发起网络请求
          wx.request({
            url: url + 'login',
            data: {
              code: res.code
            },
            method:'POST',
            success(res) {
              console.log(res.data.data.token)
              //  token保存到缓存中
              wx.request({
                url: url + 'userapi/v1/user/show',
                data: {
                  token: res.data.data.token
                },
                method:"POST",
                success(res) {
                  console.log(res.data.data)
                  that.setData({
                    userInfo: res.data.data
                  })
                }
              })

            }
          })
        } else {
          console.log('登录失败！' + res.errMsg)
        }
      }
    })

    // console.log(app.userInfo);

  },

  onLogin: function() {
    console.log('用户点击登陆')
    wx.getStorage({
      key: 'token',
      success(res) {
        console.log(res.data)
        if (res.data) {
          wx.getUserInfo({
            success(res) {
              const userInfo = res.userInfo
              const nickName = userInfo.nickName
              const avatarUrl = userInfo.avatarUrl
              const gender = userInfo.gender // 性别 0：未知、1：男、2：女
              const province = userInfo.province
              const city = userInfo.city
              const country = userInfo.country
            }
          })
        } else {
          wx.login({
            success(res) {
              if (res.code) {
                // 发起网络请求
                wx.request({
                  url: 'https://api.myphp.vip/login',
                  data: {
                    code: res.code
                  },
                  success(res) {
                    console.log(res.data.data.token)
                    //  token保存到缓存中
                    console.log('----------------');
                    wx.setStorage({
                      key: 'token',
                      data: res.data.data.token
                    })
                    console.log('----------------');
                  }
                })
              } else {
                console.log('登录失败！' + res.errMsg)
              }
            }
          })
        }
      }
    })
    
  },
  CopyLink(e) {
    wx.setClipboardData({
      data: e.currentTarget.dataset.link,
      success: res => {
        wx.showToast({
          title: '已复制',
          duration: 1000,
        })
      }
    })
  },
  // 赞赏
  showQrcode() {
    wx.previewImage({
      urls: ['https://api.myphp.vip/static/images/wechat_logo.png'],
      current: 'https://api.myphp.vip/static/images/wx_logo.jpg' // 当前显示图片的http链接      
    })
  },
  info () {
    console.log(1)
    wx.navigateTo({
      url: "../info/info"
    })
  },

























  /**
   * 生命周期函数--监听页面初次渲染完成
   */
  onReady: function() {

  },

  /**
   * 生命周期函数--监听页面显示
   */
  onShow: function() {

  },

  /**
   * 生命周期函数--监听页面隐藏
   */
  onHide: function() {

  },

  /**
   * 生命周期函数--监听页面卸载
   */
  onUnload: function() {

  },

  /**
   * 页面相关事件处理函数--监听用户下拉动作
   */
  onPullDownRefresh: function() {

  },

  /**
   * 页面上拉触底事件的处理函数
   */
  onReachBottom: function() {

  },

  /**
   * 用户点击右上角分享
   */
  onShareAppMessage: function() {

  }
})