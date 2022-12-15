'use strict';
const e = React.createElement;
const BASE_URL = "https://sfc2.kdeproduction.net/api/"

console.log(data, "HOME DATA")

const { useEffect, Fragment, useState, useRef } = React

//App
const ChatItem = ({ me, item }) => {
    if (me) {
        return (
            <Fragment>
                <div className="d-flex justify-content-between">
                    <p className="small mb-1 text-muted">{item.created_at}</p>
                    <p className="small mb-1">{item.sender && item.sender.name}</p>
                </div>
                <div className="d-flex flex-row justify-content-end mb-4 pt-1">
                    <div style={{wordBreak:'break-all'}}>
                        <p className="small p-2 me-3 mb-3 text-white rounded-3 bg-primary">{item.message}</p>
                    </div>
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                        alt="avatar 1" style={{ width: 45, height: "100%" }} />
                </div>
            </Fragment>
        )
    }

    return (
        <Fragment>
            <div className="d-flex justify-content-between">
                <p className="small mb-1">{item.sender && item.sender.name}</p>
                <p className="small mb-1 text-muted">{item.created_at}</p>
            </div>
            <div className="d-flex flex-row justify-content-start">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                    alt="avatar 1" style={{ width: 45, height: "100%" }} />
                <div style={{wordBreak:'break-all'}}>
                    <p className="small p-2 ms-3 mb-3 rounded-3" style={{ backgroundColor: "#f5f6f7" }}>{item.message}</p>
                </div>
            </div>
        </Fragment>
    )
}



const Chat = ({ messages, mainData, message, setMessage, sendMessage }) => {

    const scrollView = useRef(null);

    useEffect(() => {
        scrollView.current && scrollView.current.scrollIntoView({ behavior: "smooth" })
    }, [messages])
    return (
        <div className="row" >
            <div className="col-md-12">

                <div className="card ">
                    <div className="card-header d-flex justify-content-between border-primary border-5 align-items-center p-3"
                    >
                        <h5 className="mb-0">Chat messages</h5>
                    </div>
                    <div className="card-body overflow-scroll" data-mdb-perfect-scrollbar="true"
                        style={{ position: "relative", height: 400,overflow:"scroll",width:400 }}>

                        {messages.map((item, index) => {
                            if (mainData.userone && (item.sender.id == mainData.userone.id)) {
                                return (
                                    <ChatItem item={item} key={index} me={true} />)
                            }
                            return (
                                <ChatItem item={item} key={index} />
                            )
                        })}

                        <div ref={scrollView} />
                    </div>
                    <div className="card-footer text-muted d-flex justify-content-start align-items-center p-3">
                        <div className="input-group mb-0">
                            <input value={message} onChange={e => setMessage(e.target.value)} type="text" className="form-control" placeholder="Type message"
                                aria-label="Recipient's username" aria-describedby="button-addon2" />
                            <button onClick={sendMessage} className="btn btn-primary" type="button" id="button-addon2"
                                style={{ paddingTop: ".55rem" }}>
                                Send
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    )
}



const App = () => {

    const [mainData, setMainData] = useState(data || 'N')
    const [messages, setMessages] = useState(data.messages ? [...data.messages] : []);
    const [message, setMessage] = useState('');
    const [formData, setFormData] = useState({
        // name:"",
        // phone:"",
        message:""
    })
    
    const handleChange = e => {
        setFormData({
            ...formData,
            [e.target.name]:e.target.value
        })
    }

    const createConversation = () => {
        axios.post(BASE_URL + "create-conversation", formData)
            .then((response) => {
                console.log(response, "CREATE")
                if (response.data  && response.data.data && response.data.data.messages) {
                    setMainData(response.data.data);
                    setMessages(response.data.data.messages)
                }
            })
            .catch((err) => {
                console.log(err)
            })
    }



    useEffect(() => {
        if (mainData != 'N') {
            console.log(111)

            Pusher.logToConsole = true;

            var pusher = new Pusher('40036e58bee7eacf118f', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('chat-channel' + mainData.uuid);
            channel.bind('get-message', function (data) {
                getChats();
            });

        }

    }, [mainData]);



    const getChats = () => {
        axios.post(BASE_URL + "get-all-messages-user")
            .then((response) => {
                console.log(response, "GET ALL CHATS")
                if (response.data && response.data.data && response.data.data.messages)
                    setMessages([...response.data.data.messages])
            })
            .catch((err) => {
                console.log(err)
            })
    }


    const sendMessage = () => {
        axios.post(BASE_URL + "send-message-user", { message })
            .then((response) => {
               
                setMessage("")
                if(response.data.data == "N"){
                    alert("Chat Session Expired")
                    window.location.reload()
                }else{
                    getChats()
                }
            })
            .catch((err) => {
                console.log(err)
            })
    }

    if (mainData == 'N' && messages.length == 0) {
        return (
            <Fragment>
                <div className="row " id="start-chat-room">
                    <div className="col-md-12">

                        <div className="card ">
                            <div className="card-header d-flex justify-content-between border-primary border-5 align-items-center p-3"
                            >
                                <h5 className="mb-0">Start Chat Conversation</h5>
                            </div>
                            <div className="card-body overflow-scroll" data-mdb-perfect-scrollbar="true"
                                style={{position: "relative",minWidth: "500px"}}>

                                <div className="d-flex w-100">
                                    <form className="">
                                        {/* <div className="mb-3">
                                            <label htmlFor="phone" className="form-label">Name</label>
                                            <input type="text" placeholder="Enter Name" value={formData.name} onChange={handleChange} className="form-control" name="name" aria-describedby="emailHelp" />
                                        </div>
                                        <div className="mb-3">
                                            <label htmlFor="phone" className="form-label">Phone Number</label>
                                            <input type="phone" value={formData.phone} onChange={handleChange} placeholder="Enter Phone" className="form-control" name="phone" aria-describedby="emailHelp" />
                                        </div> */}
                                        <div className="mb-3">
                                            <label htmlFor="message" className="form-label">Message</label>
                                            <textarea value={formData.message} onChange={handleChange} className="form-control" placeholder="Enter Message Here..." name="message" rows="3"></textarea>
                                        </div>
                                        <button onClick={createConversation} type="button"  className="btn btn-primary">Send</button>
                                        <button id="is-loading" className="btn btn-primary d-none" type="button" disabled>
                                            <span className="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                            Sending...
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </Fragment>
        )
    }


    return (
        <Fragment>

            <Chat messages={messages} mainData={mainData} message={message} setMessage={setMessage} sendMessage={sendMessage} />
            <a href={`/end-chat?conv_id=${mainData.uuid}`} type="button"  className="btn btn-primary">End Chat</a>

        </Fragment>
    )
}


const domContainer = document.querySelector('#root');
const root = ReactDOM.createRoot(domContainer);
root.render(e(App));